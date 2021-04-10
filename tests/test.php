<?php

use Helpers\CommonHelpers as ch;

// for example you gets some data from web or database
$resultSet = [
    'vendors' => [
        [
            'id' => '25',
            'code' => 'apple',
            'name' => 'Apple',
        ],
        [
            'id' => '58',
            'code' => 'tesla',
            'name' => 'Tesla',
        ]
    ]
];

$firstVendor = ch::getFirstValue('vendors', $resultSet, []);

echo ch::getArrayValue('id', ch::asArray($firstVendor), '0');
