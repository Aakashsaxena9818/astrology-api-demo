<?php

require __DIR__ . '/calculators-list.php';


$arGroupCalculators = [
    'Daily Panchang' => [
        'panchang',
        'auspicious-period',
        'auspicious-period',
        'inauspicious-period',
        'choghadiya'
    ],
    'Horoscope' => [
        'birth-details',
        'kundli',
        'mangal-dosha',
        'kaal-sarp-dosha',
        'sade-sati',
        'papasamyam',
        'planet-position',
        'chart'
    ],
    'Marriage Matching' => [
        'kundli-matching',
        'nakshatra-porutham',
        'thirumana-porutham',
        'porutham',
        'papasamyam-check'
    ]
];


include __DIR__ . '/../templates/home.tpl.php';
