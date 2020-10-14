<?php

declare(strict_types=1);

use Prokerala\Api\Astrology\Location;
use Prokerala\Api\Astrology\Service\Papasamyam;
use Prokerala\Common\Api\Exception\QuotaExceededException;
use Prokerala\Common\Api\Exception\RateLimitExceededException;
use Prokerala\Common\Api\Exception\ValidationException;

require __DIR__ . '/../vendor/autoload.php';

$client = include __DIR__ . '/../client.php';

$input = [
    'datetime' => '1967-08-29T09:00:00+05:30',
    'latitude' => '19.0821978',
    'longitude' => '72.7411014', // Mumbai
];
$coordinates = $input['latitude'] . ',' . $input['longitude'];
$submit = $_POST['submit'] ?? 0;
$ayanamsa = 1;

if (isset($_POST['submit'])) {
    $input['datetime'] = $_POST['datetime'];
    $coordinates = $_POST['coordinates'];
    $arCoordinates = explode(',', $coordinates);
    $input['latitude'] = $arCoordinates[0] ?? '';
    $input['longitude'] = $arCoordinates[1] ?? '';
    $ayanamsa = $_POST['ayanamsa'];
}

$datetime = new DateTimeImmutable($input['datetime']);
$tz = $datetime->getTimezone();

$location = new Location($input['latitude'], $input['longitude'], 0, $tz);

$result = [];
$errors = [];

if ($submit) {
    try {
        $method = new Papasamyam($client);
        $method->setAyanamsa($ayanamsa);
        $result = $method->process($location, $datetime);

        $papasamyamResult['total_points'] = $result->getTotalPoints();
        $papaSamyam = $result->getPapaSamyam();
        $papaPlanets = $papaSamyam->getPapaPlanet();
        foreach ($papaPlanets as $idx => $papaPlanet) {
            $papasamyamResult['papaPlanet'][$idx]['name'] = $papaPlanet->getName();
            $planetDoshas = $papaPlanet->getPlanetDosha();
            foreach ($planetDoshas as $planetDosha) {
                $papasamyamResult['papaPlanet'][$idx]['planetDosha'][] = [
                    'id' => $planetDosha->getId(),
                    'name' => $planetDosha->getName(),
                    'position' => $planetDosha->getPosition(),
                    'hasDosha' => $planetDosha->hasDosha(),
                ];
            }
        }
    } catch (ValidationException $e) {
        $errors = $e->getValidationErrors();
    } catch (QuotaExceededException $e) {
    } catch (RateLimitExceededException $e) {
    }
}

include __DIR__ . '/../templates/papasamyam.tpl.php';
