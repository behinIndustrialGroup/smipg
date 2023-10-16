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
                'mobile' => ['type' => 'text', 'default' => '', 'required' => false],
                'phone' => ['type' => 'text', 'default' => '', 'required' => false],
                'guild_number' => ['type' => 'text', 'default' => '', 'required' => false],
                'issued_date' => ['type' => 'text', 'default' => '', 'required' => false],
                'province' => ['type' => 'select', 'default' => '', 'options' => '', 'option-url' => 'city.all'],
                'status' => [
                    'type' => 'select',
                    'default' => '',
                    'options' => [
                        ['value' => 'جدید', 'label' => 'جدید'],
                        ['value' => 'درحال بررسی', 'label' => 'در حال بررسی'],
                    ]
                ],

            ],
            'fin_fileds' => [
                '96' => ['membership96', 'memebership96_pay_date', 'memebership96_pay_file'],
                '97' => ['membership97', 'memebership97_pay_date', 'memebership97_pay_file'],
                '98' => ['membership98', 'memebership98_pay_date', 'memebership98_pay_file'],
                '99' => ['membership99', 'memebership99_pay_date', 'memebership99_pay_file'],
                '00' => ['membership00', 'memebership00_pay_date', 'memebership00_pay_file'],
                '01' => ['membership01', 'memebership01_pay_date', 'memebership01_pay_file'],
                '02' => ['membership02', 'memebership02_pay_date', 'memebership02_pay_file'],
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
                'province' => ['type' => 'select', 'default' => '', 'options' => '', 'option-url' => 'city.all'],
                'status' => [
                    'type' => 'select',
                    'default' => '',
                    'options' => [
                        ['value' => 'جدید', 'label' => 'جدید'],
                        ['value' => 'درحال بررسی', 'label' => 'در حال بررسی'],
                    ]
                ]
            ],
            'fin_fileds' => [
                '96' => ['membership96', 'memebership96_pay_date', 'memebership96_pay_file'],
                '97' => ['membership97', 'memebership97_pay_date', 'memebership97_pay_file'],
                '98' => ['membership98', 'memebership98_pay_date', 'memebership98_pay_file'],
                '99' => ['membership99', 'memebership99_pay_date', 'memebership99_pay_file'],
                '00' => ['membership00', 'memebership00_pay_date', 'memebership00_pay_file'],
                '01' => ['membership01', 'memebership01_pay_date', 'memebership01_pay_file'],
                '02' => ['membership02', 'memebership02_pay_date', 'memebership02_pay_file'],
            ]
        ],
    ]
];
