<?php

return [
    'menu' =>[
        
        'dashboard' => [
            'icon' => 'fa fa-dashboard',
            'fa_name' => 'داشبرد',
            'submenu' => [
                'dashboard' => [ 'fa_name' => 'داشبرد', 'route-name' => '', 'route-url' => 'dashboard' ],
            ]
        ],
        'cases' => [
            'icon' => 'fa fa-list',
            'fa_name' => 'کارپوشه',
            'submenu' => [
                'new-case' => [ 'fa_name' => 'فرایند جدید', 'route-name' => 'MkhodrooProcessMaker.forms.start', 'route-url' => '' ],
                'inbox' => [ 'fa_name' => 'انجام نشده', 'route-name' => 'MkhodrooProcessMaker.forms.draft', 'route-url' => '' ]
            ]
        ],
        // 'agencies' => [
        //     'fa_name' => 'مراکز',
        //     'submenu' => [
        //         'dashboard' => [ 'fa_name' => 'همه', 'route-name' => 'agency.list-form', 'route-url' => '' ],
        //     ]
        // ],
        'agencies' => [
            'icon' => 'fa fa-building',
            'fa_name' => 'اطلاعات مراکز',
            'submenu' => [
                'all' => [ 'fa_name' => 'همه', 'route-name' => 'agencyInfo.listForm', 'route-url' => '' ],
            ]
        ],
        'tickets' => [
            'icon' => 'fa fa-ticket',
            'fa_name' => 'تیکت پشتیبانی',
            'submenu' => [
                'create' => [ 'fa_name' => 'ایجاد', 'route-name' => 'ATRoutes.index', 'route-url' => '' ],
                'show' => [ 'fa_name' => 'مشاهده', 'route-name' => 'ATRoutes.show.listForm', 'route-url' => '' ],
            ]
        ],
        'users' => [
            'icon' => 'fa fa-user',
            'fa_name' => 'کاربران',
            'submenu' => [
                'dashboard' => [ 'fa_name' => 'همه', 'route-name' => '', 'route-url' => 'user/all' ],
                'role' => [ 'fa_name' => 'نقش ها', 'route-name' => 'role.listForm', 'route-url' => '' ],
            ]
        ],
        'nerkhnameh' => [
            'icon' => 'fa fa-list',
            'fa_name' => 'نرخنامه',
            'submenu' => [
                'registration' => [ 'fa_name' => 'ثبت نامی ها', 'route-name' => 'nerkhnameh.registration.listForm', 'route-url' => '' ]
            ]
        ],
        'cities' => [
            'icon' => 'fa fa-globe',
            'fa_name' => 'شهر و استان',
            'submenu' => [
                'show' => [ 'fa_name' => 'نمایش لیست', 'route-name' => 'city.index' ]
            ]
        ],
        

    ]
];