<?php

return [
    [
        'type' => 'menu-collapse',
        'menu' => 'User',
        'title' => 'Manajemen User',
        'icon_class' => 'bi bi-menu-button-wide',
        'position' => 1,
        'children' => [
            [
                'menu' => 'Admin',
                'title' => 'Manajemen Admin',
                'route' => '/user/admin',
                'hidden_children' => [
                    [
                        'title' => 'Tambah Admin',
                        'route' => '/user/admin/tambah',
                    ],
                    [
                        'title' => 'Edit Admin',
                        'route' => '/user/admin/edit/{id}',
                    ]
                ]
            ],
            [
                'menu' => 'Wajib Pajak',
                'title' => 'Manajemen Wajib Pajak',
                'route' => '/user/wajib-pajak',
                'hidden_children' => [
                    [
                        'title' => 'Tambah Wajib Pajak',
                        'route' => '/user/wajib-pajak/tambah',
                    ],
                    [
                        'title' => 'Edit Wajib Pajak',
                        'route' => '/user/wajib-pajak/edit/{id}',
                    ]
                ]
            ]

        ]
    ],
];