<?php

declare(strict_types=1);

use Prokerala\Api\Astrology\Location;
use Prokerala\Api\Astrology\Service\InauspiciousPeriod;
use Prokerala\Common\Api\Exception\AuthenticationException;
use Prokerala\Common\Api\Exception\Exception;
use Prokerala\Common\Api\Exception\QuotaExceededException;
use Prokerala\Common\Api\Exception\RateLimitExceededException;
use Prokerala\Common\Api\Exception\ValidationException;

require __DIR__ . '/bootstrap.php';

$time_now = new DateTimeImmutable();

$input = [
    'datetime' => $time_now->format('c'),
    'latitude' => '19.0821978',
    'longitude' => '72.7411014', // Mumbai
];
$coordinates = $input['latitude'] . ',' . $input['longitude'];
$submit = $_POST['submit'] ?? 0;
$ayanamsa = 1;
$sample_name = 'inauspicious-period';

$timezone = 'Asia/Kolkata';
if ($submit) {
    $input['datetime'] = $_POST['datetime'];
    $coordinates = $_POST['coordinates'];
    $arCoordinates = explode(',', $coordinates);
    $input['latitude'] = $arCoordinates[0] ?? '';
    $input['longitude'] = $arCoordinates[1] ?? '';
    $ayanamsa = $_POST['ayanamsa'];
    $timezone = $_POST['timezone'] ?? '';
}

$tz = new DateTimeZone($timezone);
$datetime = new DateTimeImmutable($input['datetime'], $tz);

$location = new Location($input['latitude'], $input['longitude'], 0, $tz);


$result = [];
$errors = [];

if ($submit) {
    try {
        $method = new InauspiciousPeriod($client);
        $method->setAyanamsa($ayanamsa);
        $method->setTimeZone($tz);
        $result = $method->process($location, $datetime);

        $inauspiciousPeriod = [];

        $arData = $result->getMuhurat();

        foreach ($arData as $idx => $data) {
            $inauspiciousPeriod[$idx] = [
                'id' => $data->getId(),
                'name' => $data->getName(),
                'type' => $data->getType(),
            ];
            $arPeriod = $data->getPeriod();
            foreach ($arPeriod as $period) {
                $inauspiciousPeriod[$idx]['period'][] = [
                    'start' => $period->getStart(),
                    'end' => $period->getEnd(),
                ];
            }
        }
    } catch (ValidationException $e) {
        $errors = $e->getValidationErrors();
    } catch (QuotaExceededException $e) {
        $errors['message'] = 'ERROR: You have exceeded your quota allocation for the day';
    } catch (RateLimitExceededException $e) {
        $errors['message'] = 'ERROR: Rate limit exceeded. Throttle your requests.';
    } catch (AuthenticationException $e) {
        $errors = ['message' => $e->getMessage()];
    } catch (Exception $e) {
        $errors = ['message' => "API Request Failed with error {$e->getMessage()}"];
    }
}

$apiCreditUsed = $client->getCreditUsed();
include DEMO_BASE_DIR . '/templates/inauspicious-period.tpl.php';
