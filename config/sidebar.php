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
        'workflow-inbox' => [
            'icon' => '',
            'fa_name' => 'کارتابل',
            'submenu' => [
                'new-process' => [ 'fa_name' => 'فرایند جدید', 'route-name' => 'simpleWorkflow.process.startListView' ],
                'inbox' => [ 'fa_name' => 'کارتابل من', 'route-name' => 'simpleWorkflow.inbox.index' ],
                'done-inbox' => [ 'fa_name' => 'انجام شده ها', 'route-name' => 'simpleWorkflow.inbox.done' ],
            ]
        ],
        'workflow' => [
            'icon' => '',
            'fa_name' => 'گردش کار',
            'submenu' => [
                'process' => [ 'fa_name' => 'فرایند', 'route-name' => 'simpleWorkflow.process.index' ],
                'task-actors' => [ 'fa_name' => 'تسک ها', 'route-name' => 'simpleWorkflow.task-actors.index' ],
                'forms' => [ 'fa_name' => 'فرم ها', 'route-name' => 'simpleWorkflow.form.index'  ],
                'scripts' => [ 'fa_name' => 'اسکریپت ها', 'route-name' => 'simpleWorkflow.scripts.index' ],
                'conditions' => [ 'fa_name' => 'شرط ها', 'route-name' => 'simpleWorkflow.conditions.index' ],
                'fields' => [ 'fa_name' => 'فیلدها', 'route-name' => 'simpleWorkflow.fields.index' ],
                'entities' => [ 'fa_name' => 'موجودیت ها', 'route-name' => 'simpleWorkflow.entities.index' ],
                'all-inbox' => [ 'fa_name' => 'کارتابل همه', 'route-name' => 'simpleWorkflow.inbox.cases.list' ],
            ]
        ],
        'workflow-report' => [
            'icon' => '',
            'fa_name' => 'گزارشات کارتابل',
            'submenu' => [
                // 'list' => [ 'fa_name' => 'لیست', 'route-name' => 'simpleWorkflowReport.index' ],
                'summary' => [ 'fa_name' => 'خلاصه گزارش', 'route-name' => 'simpleWorkflowReport.summary-report.index' ],
                // 'role-form-control' => [ 'fa_name' => 'فرم گزارش نقش ها', 'route-name' => 'simpleWorkflowReport.role.index' ],
            ]
        ],
        'agencies' => [
            'icon' => 'fa fa-building',
            'fa_name' => 'اطلاعات مراکز',
            'submenu' => [
                'all' => [ 'fa_name' => 'همه', 'route-name' => 'agencyInfo.listForm', 'route-url' => '' ],
                'excel-input' => [ 'fa_name' => 'ورود با اکسل', 'route-name' => 'excelReader.input', 'route-url' => '' ],
            ]
        ],
        'agency-report' => [
            'icon' => 'fa fa-file',
            'fa_name' => 'گزارشات',
            'submenu' => [
                'all' => [ 'fa_name' => 'همه', 'route-name' => 'agencyInfoReport.index', 'route-url' => '' ],
            ]
        ],
        'marketing-card' => [
            'icon' => 'fa fa-credit-card',
            'fa_name' => 'کارت بازاریابی',
            'submenu' => [
                'list' => [ 'fa_name' => 'لیست', 'route-name' => 'marketingcard.index', 'route-url' => '/marketingcard' ],
            ]
        ],
        'tickets' => [
            'icon' => 'fa fa-ticket-alt',
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
