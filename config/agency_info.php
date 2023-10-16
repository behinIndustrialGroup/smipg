<?php

return [
    'agency' => [
        'safety-charge' => [
            'catagory_fa' => 'ایمنی و شارژ',
            'fields' => [
                'file_number' => ['type' => 'text', 'required' => true],
                'catagory' => ['type' => 'text', 'default' => 'ایمنی و شارژ', 'required' => false],
                'firstname' => ['type' => 'text', 'default' => '', 'required' => false],
                'lastname' => ['type' => 'text', 'default' => '', 'required' => false],
                'national_id' => ['type' => 'text', 'default' => '', 'required' => false],
                'province' => ['type' => 'select', 'default' => '', 'options' => '' , 'option-url' => 'city.all'],
                'status' => [
                    'type' => 'select', 
                    'default' => '', 
                    'options' => [
                        ['value' => 'جدید', 'label' => 'جدید'],
                        ['value' => 'درحال بررسی', 'label' => 'در حال بررسی'],
                    ]
                ]
            ]
        ],
        'industrial-charge' => [
            'catagory_fa' => 'صنعتی و شارژ',
            'fields' => [
                'file_number' => ['type' => 'text', 'required' => true],
                'catagory' => ['type' => 'text', 'default' => 'صنعتی و شارژ', 'required' => false],
                'firstname' => ['type' => 'text', 'default' => '', 'required' => false],
                'lastname' => ['type' => 'text', 'default' => '', 'required' => false],
                'national_id' => ['type' => 'text', 'default' => '', 'required' => false],
                'province' => ['type' => 'select', 'default' => '', 'options' => '' , 'option-url' => 'city.all'],
                'status' => [
                    'type' => 'select', 
                    'default' => '', 
                    'options' => [
                        ['value' => 'جدید', 'label' => 'جدید'],
                        ['value' => 'درحال بررسی', 'label' => 'در حال بررسی'],  
                    ]
                ]
            ]
        ],
    ]
];
