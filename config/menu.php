<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Admin Navigation Menu
    |--------------------------------------------------------------------------
    |
    | This array is for Navigation menus of the backend.  Just add/edit or
    | remove the elements from this array which will automatically change the
    | navigation.
    |
    */

    // SIDEBAR LAYOUT - MENU

    'sidebar' => [],
    'horizontal' => [

        [
            'title' => 'Assessment',
            'link' => '/admin/projects/',
            'active' => 'admin/dashboard*',
            'icon' => 'icon-fa icon-fa-th-large',

        ],
        [
            'title'=>'Concessionaire',
            'link'=>'/admin/concessionaires',
            'active'=>'/admin/concessionaires*',
            'icon'=>'icon-fa icon-fa-road'
        ],
        [
            'title'=>'Assessor ',
            'link'=>'/admin/auditors',
            'active'=>'/admin/auditors*',
            'icon'=>'icon-fa icon-fa-barcode'
        ],
        [
            'title'=>'Admins',
            'link'=>'/admin/admins',
            'active'=>'/admin/admins*',
            'icon'=>'icon-fa icon-fa-users'
        ],
        [
            'title' => 'Settings',
            'link' => '#',
            'active' => 'admin/settings*',
            'icon' => 'icon-fa icon-fa-cogs',
            'children' => [
                [
                    'title' => 'Keywords',
                    'link' => '/admin/settings/keywords',
                    'active' => 'admin/settings/keywords',
                ],
                [
                    'title' => 'Constants',
                    'link' => 'admin/settings/constants',
                    'active' => 'admin/settings/constants',
                ],
                [
                    'title' => 'Highway List',
                    'link' => 'admin/settings/highwaylist',
                    'active' => 'admin/settings/highwaylist',
                ],
                [
                    'title' => 'Logout',
                    'link' => 'logout',
                    'active' => 'admin/settings/highwaylist',
                ]
            ]
        ],
    ]
];
