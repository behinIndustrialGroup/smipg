<?php

return [
    'agency' => [
        'safety-charge' => [
            'catagory_fa' => 'ایمنی و شارژ',
            'fields' => [
                'catagory' => ['type' => 'text', 'default' => 'ایمنی و شارژ', 'required' => false],
                'firstname' => ['type' => 'text', 'default' => '', 'required' => false],
                'lastname' => ['type' => 'text', 'default' => '', 'required' => false],
                'national_id' => ['type' => 'text', 'default' => '', 'required' => false],
                'province' => ['type' => 'select', 'default' => '', 'options' => ''],
                'city' => ['type' => 'select', 'default' => '', 'options' => ''],
                'status' => [
                    'type' => 'select', 
                    'default' => '', 
                    'options' => [
                        ['value' => 'new', 'label' => 'جدید'],
                        ['value' => 'in progress', 'label' => 'در حال بررسی'],
                        ['value' => '', 'label' => ''],
                    ]
                ]
            ]
        ],
        'industrial-charge' => [
            'catagory_fa' => 'صنعتی و شارژ',
            'fields' => [
                'catagory' => ['type' => 'text', 'default' => 'صنعتی و شارژ', 'required' => false],
                'firstname' => ['type' => 'text', 'default' => '', 'required' => false],
                'lastname' => ['type' => 'text', 'default' => '', 'required' => false],
                'national_id' => ['type' => 'text', 'default' => '', 'required' => false],
                'province' => ['type' => 'select', 'default' => '', 'options' => ''],
                'city' => ['type' => 'select', 'default' => '', 'options' => ''],
                'status' => [
                    'type' => 'select', 
                    'default' => '', 
                    'options' => [
                        ['value' => 'new', 'label' => 'جدید'],
                        ['value' => 'in progress', 'label' => 'در حال بررسی'],
                        ['value' => '', 'label' => ''],
                    ]
                ]
            ]
        ],
    ]
];
