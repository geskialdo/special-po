<?php

return [
    [
        'type' => 'heading',
        'title' => 'Menu',
        'position' => 0,
    ],
    [
        'type' => 'menu',
        'menu' => 'Dashboard',
        'title' => 'Dashboard',
        'route' => '/dashboard',
        'icon_class' => 'bi bi-grid',
        'position' => 1,
        'hidden_children' => []
    ],
    // [
    //     'type' => 'menu',
    //     'menu' => 'Objek Pajak',
    //     'title' => 'Daftar Objek Pajak',
    //     'route' => '/objek-pajak',
    //     'icon_class' => 'bi bi-gear',
    //     'position' => 1,
    //     'hidden_children' => []
    // ],
    // [
    //     'type' => 'menu-collapse',
    //     'menu' => 'Components',
    //     'title' => 'Components',
    //     'icon_class' => 'bi bi-menu-button-wide',
    //     'position' => 1,
    //     'children' => [
    //         [
    //             'menu' => 'Alerts',
    //             'title' => 'Badges',
    //             'route' => '/alerts',
    //             'hidden_children' => [
    //                 [
    //                     'title' => 'Edit Alert',
    //                     'route' => '/alerts/edit',
    //                 ]
    //             ]
    //         ],
    //         [
    //             'menu' => 'Badges',
    //             'title' => 'Badges',
    //             'route' => '/badges',
    //             'hidden_children' => [
    //                 [
    //                     'title' => 'Edit Badge',
    //                     'route' => '/badges/edit',
    //                 ]
    //             ]
    //         ]

    //     ]
    // ],
    // [
    //     'type' => 'menu-collapse',
    //     'menu' => 'Tables',
    //     'title' => 'Tables',
    //     'icon_class' => 'bi bi-menu-button-wide',
    //     'position' => 1,
    //     'children' => [
    //         [
    //             'menu' => 'Normal Tables',
    //             'title' => 'Normal Tables',
    //             'route' => '/normal-tables',
    //             'hidden_children' => [
    //                 [
    //                     'title' => 'Edit Normal Tables',
    //                     'route' => '/normal-tables/edit',
    //                 ]
    //             ]
    //         ],
    //         [
    //             'menu' => 'Datatables',
    //             'title' => 'Datatables',
    //             'route' => '/datatables',
    //             'hidden_children' => [
    //                 [
    //                     'title' => 'Edit Datatables',
    //                     'route' => '/datatables/edit',
    //                 ]
    //             ]
    //         ]

    //     ]
    // ],
];