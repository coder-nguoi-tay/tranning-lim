<?php

use App\Enums\RoleEnum;

return [
    'customer' => [
        'view' => [RoleEnum::ADMIN],
        'store' => [RoleEnum::ADMIN],
        'update' => [RoleEnum::ADMIN],
        'delete' => [RoleEnum::ADMIN],
    ],
    'user' => [
        'view' => [RoleEnum::ADMIN],
        'store' => [RoleEnum::ADMIN],
        'update' => [RoleEnum::ADMIN],
        'delete' => [RoleEnum::ADMIN],
    ],
    'package' => [
        'view' => [RoleEnum::ADMIN],
        'store' => [RoleEnum::ADMIN],
        'update' => [RoleEnum::ADMIN],
        'delete' => [RoleEnum::ADMIN],
    ],
    'shipment' => [
        'view' => [RoleEnum::ADMIN],
        'store' => [RoleEnum::ADMIN],
        'update' => [RoleEnum::ADMIN],
        'delete' => [RoleEnum::ADMIN],
    ]
    // 'role' => [
    //     'customer' => [
    //         'user' => [],
    //         'package' => ['view', 'store', 'show', 'update', 'delete'],
    //         'shipment' => [],
    //     ],
    //     'admin' => [
    //         'user' => ['view', 'store', 'show', 'update', 'delete'],
    //         'package' => ['view', 'store', 'show', 'update', 'delete'],
    //         'shipment' => ['view', 'store', 'show', 'update', 'delete'],
    //     ],
    //     'employ' => [
    //         'user' => [],
    //         'package' => ['view', 'store', 'show', 'update', 'delete'],
    //         'shipment' => [],
    //     ],
    // ]
];
