<?php

return [
    'menu' => [
        [
            'text' => 'Navigation',
            'is_header' => true
        ],
        [
            'url' => '/',
            'icon' => 'far fa-chart-bar',
            'text' => 'Dashboard'
        ],
        [
            'url' => '/expense',
            'icon' => 'fa fa-money-bill-alt',
            'text' => 'Expense'
        ],
        [
            'url' => '/category',
            'icon' => 'far fa-list-alt',
            'text' => 'Category'
        ],
        [
            'icon' => 'far fa-user-circle',
            'text' => 'People',
            'children' => [
                [
                    'url' => '/user',
                    'text' => 'User'
                ],
                [
                    'url' => '/role',
                    'text' => 'Role'
                ],
                [
                    'url' => '/permission',
                    'text' => 'Permission'
                ],
            ]
        ],
        [
            'url' => '/department',
            'icon' => 'far fa-building',
            'text' => 'Department'
        ],
        [
            'url' => '/recurring',
            'icon' => 'far fa-play-circle',
            'text' => 'Recurring'
        ],
        [
            'icon' => 'far fa-file-alt',
            'text' => 'Report',
            'children' => [
                [
                    'url' => '/expense_report',
                    'action' => 'Bootstrap',
                    'text' => 'Expense Report'
                ],
                [
                    'url' => '/recurring_report',
                    'text' => 'Recurring Report'
                ],
                [
                    'url' => '/payment_report',
                    'text' => 'Payment Report'
                ],
            ]
        ],
        [
            'is_divider' => true
        ],
        [
            'url' => '/analytics',
            'icon' => 'fa fa-chart-pie',
            'text' => 'Testing'
        ],
    ]
];