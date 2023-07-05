<?php

return [
    [
        'type' => 'menu',
        'menu' => 'BPHTB',
        'title' => 'BPHTB',
        'route' => '/bphtb',
        'icon_class' => 'bi bi-grid',
        'position' => 2,
        'hidden_children' => [
            [
                'title' => 'Tambah BPHTB',
                'route' => '/bphtb/tambah',
            ],
            [
                'title' => 'Edit BPHTB',
                'route' => '/bphtb/edit/{id}',
            ]
        ]
    ],
];