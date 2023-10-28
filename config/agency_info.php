<?php

return [
    'fin_uploads' => 'fin_uploads',
    'main_field_name' => 'guild_catagory',
    'agency' => [
        'charging-fire-cylenders' => [
            'catagory_fa' => 'شارژ سیلندرهای آتش نشانی',
            'fields' => [
                'file_number' => ['type' => 'text', 'required' => true],
                'guild_catagory' => ['type' => 'text', 'default' => 'شارژ سیلندرهای آتش نشانی', 'required' => false],
                'catagory' => [
                    'type' => 'select',
                    'default' => '',
                    'options' => [
                        ['value' => 'industrial', 'label' => 'صنعتی'],
                        ['value' => 'safety', 'label' => 'ایمنی'],
                    ]
                ],
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
                'description' => ['type' => 'text', 'default' => '', 'required' => false],

            ],
            'fin_fileds' => [
                '96' => ['membership96', 'memebership96_pay_date', 'memebership96_pay_file'],
                '97' => ['membership97', 'memebership97_pay_date', 'memebership97_pay_file'],
                '98' => ['membership98', 'memebership98_pay_date', 'memebership98_pay_file'],
                '99' => ['membership99', 'memebership99_pay_date', 'memebership99_pay_file'],
                '00' => ['membership00', 'memebership00_pay_date', 'memebership00_pay_file'],
                '01' => ['membership01', 'memebership01_pay_date', 'memebership01_pay_file'],
                '02' => ['membership02', 'memebership02_pay_date', 'memebership02_pay_file'],
            ],
            'docs' => [
                'national_card',
                'birth_certificate_image',
                'personal_image', 
            ]
        ],
        'retail' => [
            'catagory_fa' => 'خرده فروشی گازهای طبی و صنعتی',
            'fields' => [
                'file_number' => ['type' => 'text', 'required' => true],
                'guild_catagory' => ['type' => 'text', 'default' => 'خرده فروشی گازهای طبی و صنعتی', 'required' => false],
                'catagory' => [
                    'type' => 'select',
                    'default' => '',
                    'options' => [
                        ['value' => 'industrial', 'label' => 'صنعتی'],
                        ['value' => 'safety', 'label' => 'ایمنی'],
                    ]
                ],
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
                'description' => ['type' => 'text', 'default' => '', 'required' => false],


            ],
            'fin_fileds' => [
                '96' => ['membership96', 'memebership96_pay_date', 'memebership96_pay_file'],
                '97' => ['membership97', 'memebership97_pay_date', 'memebership97_pay_file'],
                '98' => ['membership98', 'memebership98_pay_date', 'memebership98_pay_file'],
                '99' => ['membership99', 'memebership99_pay_date', 'memebership99_pay_file'],
                '00' => ['membership00', 'memebership00_pay_date', 'memebership00_pay_file'],
                '01' => ['membership01', 'memebership01_pay_date', 'memebership01_pay_file'],
                '02' => ['membership02', 'memebership02_pay_date', 'memebership02_pay_file'],
            ],
            'docs' => [
                'national_card',
                'birth_certificate_image',
                'personal_image', 
            ]
        ],
        'sale-and-charging-insdustrial-gas' => [
            'catagory_fa' => 'شارژ و فروش گازهای طبی و صنعتی',
            'fields' => [
                'file_number' => ['type' => 'text', 'required' => true],
                'guild_catagory' => ['type' => 'text', 'default' => 'شارژ و فروش گازهای طبی و صنعتی', 'required' => false],
                'catagory' => [
                    'type' => 'select',
                    'default' => '',
                    'options' => [
                        ['value' => 'industrial', 'label' => 'صنعتی'],
                        ['value' => 'safety', 'label' => 'ایمنی'],
                    ]
                ],
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
            ],
            'docs' => [
                'national_card',
                'birth_certificate_image',
                'personal_image', 
            ]
        ],
        'saling-fire-cylenders' => [
            'catagory_fa' => 'فروش سیلندرهای آتش نشانی',
            'fields' => [
                'file_number' => ['type' => 'text', 'required' => true],
                'guild_catagory' => ['type' => 'text', 'default' => 'فروش سیلندرهای آتش نشانی', 'required' => false],
                'catagory' => [
                    'type' => 'select',
                    'default' => '',
                    'options' => [
                        ['value' => 'industrial', 'label' => 'صنعتی'],
                        ['value' => 'safety', 'label' => 'ایمنی'],
                    ]
                ],
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
                'description' => ['type' => 'text', 'default' => '', 'required' => false],


            ],
            'fin_fileds' => [
                '96' => ['membership96', 'memebership96_pay_date', 'memebership96_pay_file'],
                '97' => ['membership97', 'memebership97_pay_date', 'memebership97_pay_file'],
                '98' => ['membership98', 'memebership98_pay_date', 'memebership98_pay_file'],
                '99' => ['membership99', 'memebership99_pay_date', 'memebership99_pay_file'],
                '00' => ['membership00', 'memebership00_pay_date', 'memebership00_pay_file'],
                '01' => ['membership01', 'memebership01_pay_date', 'memebership01_pay_file'],
                '02' => ['membership02', 'memebership02_pay_date', 'memebership02_pay_file'],
            ],
            'docs' => [
                'national_card',
                'birth_certificate_image',
                'personal_image', 
            ]
        ],
        'wholesaling-industrial-gas' => [
            'catagory_fa' => 'عمده فروشی گازهای طبی و صنعتی',
            'fields' => [
                'file_number' => ['type' => 'text', 'required' => true],
                'guild_catagory' => ['type' => 'text', 'default' => 'عمده فروشی گازهای طبی و صنعتی', 'required' => false],
                'catagory' => [
                    'type' => 'select',
                    'default' => '',
                    'options' => [
                        ['value' => 'industrial', 'label' => 'صنعتی'],
                        ['value' => 'safety', 'label' => 'ایمنی'],
                    ]
                ],
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
                'description' => ['type' => 'text', 'default' => '', 'required' => false],


            ],
            'fin_fileds' => [
                '96' => ['membership96', 'memebership96_pay_date', 'memebership96_pay_file'],
                '97' => ['membership97', 'memebership97_pay_date', 'memebership97_pay_file'],
                '98' => ['membership98', 'memebership98_pay_date', 'memebership98_pay_file'],
                '99' => ['membership99', 'memebership99_pay_date', 'memebership99_pay_file'],
                '00' => ['membership00', 'memebership00_pay_date', 'memebership00_pay_file'],
                '01' => ['membership01', 'memebership01_pay_date', 'memebership01_pay_file'],
                '02' => ['membership02', 'memebership02_pay_date', 'memebership02_pay_file'],
            ],
            'docs' => [
                'national_card',
                'birth_certificate_image',
                'personal_image', 
            ]
        ],
        'producer' => [
            'catagory_fa' => 'تولیدکننده',
            'fields' => [
                'file_number' => ['type' => 'text', 'required' => true],
                'guild_catagory' => ['type' => 'text', 'default' => 'تولیدکننده', 'required' => false],
                'catagory' => [
                    'type' => 'select',
                    'default' => '',
                    'options' => [
                        ['value' => 'industrial', 'label' => 'صنعتی'],
                        ['value' => 'safety', 'label' => 'ایمنی'],
                    ]
                ],
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
            ],
            'docs' => [
                'national_card',
                'birth_certificate_image',
                'personal_image', 
            ]
        ],
        'unknown' => [
            'catagory_fa' => 'بدون رسته',
            'fields' => [
                'file_number' => ['type' => 'text', 'required' => true],
                'guild_catagory' => ['type' => 'text', 'default' => 'بدون رسته', 'required' => false],
                'catagory' => [
                    'type' => 'select',
                    'default' => '',
                    'options' => [
                        ['value' => 'industrial', 'label' => 'صنعتی'],
                        ['value' => 'safety', 'label' => 'ایمنی'],
                    ]
                ],
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
                'description' => ['type' => 'text', 'default' => '', 'required' => false],


            ],
            'fin_fileds' => [
                '96' => ['membership96', 'memebership96_pay_date', 'memebership96_pay_file'],
                '97' => ['membership97', 'memebership97_pay_date', 'memebership97_pay_file'],
                '98' => ['membership98', 'memebership98_pay_date', 'memebership98_pay_file'],
                '99' => ['membership99', 'memebership99_pay_date', 'memebership99_pay_file'],
                '00' => ['membership00', 'memebership00_pay_date', 'memebership00_pay_file'],
                '01' => ['membership01', 'memebership01_pay_date', 'memebership01_pay_file'],
                '02' => ['membership02', 'memebership02_pay_date', 'memebership02_pay_file'],
            ],
            'docs' => [
                'national_card',
                'birth_certificate_image',
                'personal_image', 
            ]
        ],
    ]
];
