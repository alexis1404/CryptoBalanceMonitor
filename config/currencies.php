<?php

return [
    'explorer' => [
        'btc' => env('BTC_EXPLORER'),
        'eth' => env('ETH_EXPLORER'),
        'ltc' => env('LTC_EXPLORER'),
    ],
    'api_key' => [
        'eth_explorer_api_key' => env('ETH_EXPLORER_API_KEY'),
    ],
    'assets_data' => [/* Ассеты не должны находиться в конфиге. Их место - в БД + поинты для управления ими,
                      но в рамках данного приложения не запрошен этот функционал */
        'btc' => [
            'ticker' => 'BTC',
            'decimal' => 8,
        ],
        'ltc' => [
            'ticker' => 'LTC',
            'decimal' => 8,
        ],
        'eth' => [
            'ticker' => 'ETH',
            'decimal' => 18,
        ]
    ],
];
