<?php

return [
    'fin_uploads' => 'fin_uploads',
    'main_field_name' => 'guild_catagory',
    'default_fields' => ['guild_catagory','firstname', 'lastname', 'national_id', 'agency_code', 'status', 'mobile'],
    'valid_file_type' => ['image/jpg', 'image/jpeg', 'image/png', 'application/pdf'],
    'customer_type' => [
        'charging-fire-cylenders' => [
            'name' => 'charging fire cylenders',
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
                'reviewer' => [
                    'type' => 'select',
                    'default' => '',
                    'options' => [
                        ['value' => 'اصفهانی', 'label' => 'اصفهانی'],
                        ['value' => 'اسدی', 'label' => 'اسدی'],
                        ['value' => 'حیدری', 'label' => 'حیدری'],
                        ['value' => 'نعمتی', 'label' => 'نعمتی'],
                        ['value' => 'مقدسی', 'label' => 'مقدسی'],
                        ['value' => 'میرزایی', 'label' => 'میرزایی'],
                        ['value' => 'بام افکن', 'label' => 'بام افکن'],
                    ]
                ],
                'description' => ['type' => 'text', 'default' => '', 'required' => false],

            ],
            'memberships' => [
                '96' => ['membership_96', 'membership_96_pay_date', 'membership_96_ref_id', 'membership_96_pay_file'],
                '97' => ['membership_97', 'membership_97_pay_date', 'membership_97_ref_id', 'membership_97_pay_file'],
                '98' => ['membership_98', 'membership_98_pay_date', 'membership_98_ref_id', 'membership_98_pay_file'],
                '99' => ['membership_99', 'membership_99_pay_date', 'membership_99_ref_id', 'membership_99_pay_file'],
                '00' => ['membership_00', 'membership_00_pay_date', 'membership_00_ref_id', 'membership_00_pay_file'],
                '01' => ['membership_01', 'membership_01_pay_date', 'membership_01_ref_id', 'membership_01_pay_file'],
                '02' => ['membership_02', 'membership_02_pay_date', 'membership_02_ref_id', 'membership_02_pay_file'],
                'donate1' => ['donate1', 'donate1_pay_date', 'donate1_ref_id', 'donate1_pay_file'],
            ],
            'fin_fields' => [
                'fin_details' => ['type' => 'textarea'],
                'fin_green' => [
                    'type' => 'select',
                    'default' => '',
                    'options' => [
                        ['value' => 'not ok', 'label' => 'غیرفعال'],
                        ['value' => 'ok', 'label' => 'فعال'],
                    ]
                ],
                
            ],
            'debts' => [
                '1' => [ 'debt1', 'debt1_pay_date', 'debt1_ref_id', 'debt1_description' ],
            ],
            'docs' => [
                'national_card',
                'birth_certificate_image',
                'personal_image', 
            ]
        ],
        'retail' => [
            'name' => 'retail',
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
                'reviewer' => [
                    'type' => 'select',
                    'default' => '',
                    'options' => [
                        ['value' => 'اصفهانی', 'label' => 'اصفهانی'],
                        ['value' => 'اسدی', 'label' => 'اسدی'],
                        ['value' => 'حیدری', 'label' => 'حیدری'],
                        ['value' => 'نعمتی', 'label' => 'نعمتی'],
                        ['value' => 'مقدسی', 'label' => 'مقدسی'],
                        ['value' => 'میرزایی', 'label' => 'میرزایی'],
                        ['value' => 'بام افکن', 'label' => 'بام افکن'],
                    ]
                ],
                'description' => ['type' => 'text', 'default' => '', 'required' => false],


            ],
            'memberships' => [
                '96' => ['membership_96', 'membership_96_pay_date', 'membership_96_ref_id', 'membership_96_pay_file'],
                '97' => ['membership_97', 'membership_97_pay_date', 'membership_97_ref_id', 'membership_97_pay_file'],
                '98' => ['membership_98', 'membership_98_pay_date', 'membership_98_ref_id', 'membership_98_pay_file'],
                '99' => ['membership_99', 'membership_99_pay_date', 'membership_99_ref_id', 'membership_99_pay_file'],
                '00' => ['membership_00', 'membership_00_pay_date', 'membership_00_ref_id', 'membership_00_pay_file'],
                '01' => ['membership_01', 'membership_01_pay_date', 'membership_01_ref_id', 'membership_01_pay_file'],
                '02' => ['membership_02', 'membership_02_pay_date', 'membership_02_ref_id', 'membership_02_pay_file'],
                'donate1' => ['donate1', 'donate1_pay_date', 'donate1_ref_id', 'donate1_pay_file'],
            ],
            'fin_fields' => [
                'fin_details' => ['type' => 'textarea'],
                'fin_green' => [
                    'type' => 'select',
                    'default' => '',
                    'options' => [
                        ['value' => 'not ok', 'label' => 'غیرفعال'],
                        ['value' => 'ok', 'label' => 'فعال'],
                    ]
                ],
                
            ],
            'debts' => [
                '1' => [ 'debt1', 'debt1_pay_date', 'debt1_ref_id', 'debt1_description' ],
            ],
            'docs' => [
                'national_card',
                'birth_certificate_image',
                'personal_image', 
            ]
        ],
        'sale-and-charging-insdustrial-gas' => [
            'name' => 'sale and charging insdustrial gas',
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
                'reviewer' => [
                    'type' => 'select',
                    'default' => '',
                    'options' => [
                        ['value' => 'اصفهانی', 'label' => 'اصفهانی'],
                        ['value' => 'اسدی', 'label' => 'اسدی'],
                        ['value' => 'حیدری', 'label' => 'حیدری'],
                        ['value' => 'نعمتی', 'label' => 'نعمتی'],
                        ['value' => 'مقدسی', 'label' => 'مقدسی'],
                        ['value' => 'میرزایی', 'label' => 'میرزایی'],
                        ['value' => 'بام افکن', 'label' => 'بام افکن'],
                    ]
                ],
                'description' => ['type' => 'text', 'default' => '', 'required' => false],

            ],
            'memberships' => [
                '96' => ['membership_96', 'membership_96_pay_date', 'membership_96_ref_id', 'membership_96_pay_file'],
                '97' => ['membership_97', 'membership_97_pay_date', 'membership_97_ref_id', 'membership_97_pay_file'],
                '98' => ['membership_98', 'membership_98_pay_date', 'membership_98_ref_id', 'membership_98_pay_file'],
                '99' => ['membership_99', 'membership_99_pay_date', 'membership_99_ref_id', 'membership_99_pay_file'],
                '00' => ['membership_00', 'membership_00_pay_date', 'membership_00_ref_id', 'membership_00_pay_file'],
                '01' => ['membership_01', 'membership_01_pay_date', 'membership_01_ref_id', 'membership_01_pay_file'],
                '02' => ['membership_02', 'membership_02_pay_date', 'membership_02_ref_id', 'membership_02_pay_file'],
                'donate1' => ['donate1', 'donate1_pay_date', 'donate1_ref_id', 'donate1_pay_file'],
            ],
            'fin_fields' => [
                'fin_details' => ['type' => 'textarea'],
                'fin_green' => [
                    'type' => 'select',
                    'default' => '',
                    'options' => [
                        ['value' => 'not ok', 'label' => 'غیرفعال'],
                        ['value' => 'ok', 'label' => 'فعال'],
                    ]
                ],
                
            ],
            'debts' => [
                '1' => [ 'debt1', 'debt1_pay_date', 'debt1_ref_id', 'debt1_description' ],
            ],
            'docs' => [
                'national_card',
                'birth_certificate_image',
                'personal_image', 
            ]
        ],
        'saling-fire-cylenders' => [
            'name' => 'saling fire cylenders',
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
                'reviewer' => [
                    'type' => 'select',
                    'default' => '',
                    'options' => [
                        ['value' => 'اصفهانی', 'label' => 'اصفهانی'],
                        ['value' => 'اسدی', 'label' => 'اسدی'],
                        ['value' => 'حیدری', 'label' => 'حیدری'],
                        ['value' => 'نعمتی', 'label' => 'نعمتی'],
                        ['value' => 'مقدسی', 'label' => 'مقدسی'],
                        ['value' => 'میرزایی', 'label' => 'میرزایی'],
                        ['value' => 'بام افکن', 'label' => 'بام افکن'],
                    ]
                ],
                'description' => ['type' => 'text', 'default' => '', 'required' => false],


            ],
            'memberships' => [
                '96' => ['membership_96', 'membership_96_pay_date', 'membership_96_ref_id', 'membership_96_pay_file'],
                '97' => ['membership_97', 'membership_97_pay_date', 'membership_97_ref_id', 'membership_97_pay_file'],
                '98' => ['membership_98', 'membership_98_pay_date', 'membership_98_ref_id', 'membership_98_pay_file'],
                '99' => ['membership_99', 'membership_99_pay_date', 'membership_99_ref_id', 'membership_99_pay_file'],
                '00' => ['membership_00', 'membership_00_pay_date', 'membership_00_ref_id', 'membership_00_pay_file'],
                '01' => ['membership_01', 'membership_01_pay_date', 'membership_01_ref_id', 'membership_01_pay_file'],
                '02' => ['membership_02', 'membership_02_pay_date', 'membership_02_ref_id', 'membership_02_pay_file'],
                'donate1' => ['donate1', 'donate1_pay_date', 'donate1_ref_id', 'donate1_pay_file'],
            ],
            'fin_fields' => [
                'fin_details' => ['type' => 'textarea'],
                'fin_green' => [
                    'type' => 'select',
                    'default' => '',
                    'options' => [
                        ['value' => 'not ok', 'label' => 'غیرفعال'],
                        ['value' => 'ok', 'label' => 'فعال'],
                    ]
                ],
                
            ],
            'debts' => [
                '1' => [ 'debt1', 'debt1_pay_date', 'debt1_ref_id', 'debt1_description' ],
            ],
            'docs' => [
                'national_card',
                'birth_certificate_image',
                'personal_image', 
            ]
        ],
        'wholesaling-industrial-gas' => [
            'name' => 'wholesaling industrial gas',
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
                'reviewer' => [
                    'type' => 'select',
                    'default' => '',
                    'options' => [
                        ['value' => 'اصفهانی', 'label' => 'اصفهانی'],
                        ['value' => 'اسدی', 'label' => 'اسدی'],
                        ['value' => 'حیدری', 'label' => 'حیدری'],
                        ['value' => 'نعمتی', 'label' => 'نعمتی'],
                        ['value' => 'مقدسی', 'label' => 'مقدسی'],
                        ['value' => 'میرزایی', 'label' => 'میرزایی'],
                        ['value' => 'بام افکن', 'label' => 'بام افکن'],
                    ]
                ],
                'description' => ['type' => 'text', 'default' => '', 'required' => false],


            ],
            'memberships' => [
                '96' => ['membership_96', 'membership_96_pay_date', 'membership_96_ref_id', 'membership_96_pay_file'],
                '97' => ['membership_97', 'membership_97_pay_date', 'membership_97_ref_id', 'membership_97_pay_file'],
                '98' => ['membership_98', 'membership_98_pay_date', 'membership_98_ref_id', 'membership_98_pay_file'],
                '99' => ['membership_99', 'membership_99_pay_date', 'membership_99_ref_id', 'membership_99_pay_file'],
                '00' => ['membership_00', 'membership_00_pay_date', 'membership_00_ref_id', 'membership_00_pay_file'],
                '01' => ['membership_01', 'membership_01_pay_date', 'membership_01_ref_id', 'membership_01_pay_file'],
                '02' => ['membership_02', 'membership_02_pay_date', 'membership_02_ref_id', 'membership_02_pay_file'],
                'donate1' => ['donate1', 'donate1_pay_date', 'donate1_ref_id', 'donate1_pay_file'],
            ],
            'fin_fields' => [
                'fin_details' => ['type' => 'textarea'],
                'fin_green' => [
                    'type' => 'select',
                    'default' => '',
                    'options' => [
                        ['value' => 'not ok', 'label' => 'غیرفعال'],
                        ['value' => 'ok', 'label' => 'فعال'],
                    ]
                ],
                
            ],
            'debts' => [
                '1' => [ 'debt1', 'debt1_pay_date', 'debt1_ref_id', 'debt1_description' ],
            ],
            'docs' => [
                'national_card',
                'birth_certificate_image',
                'personal_image', 
            ]
        ],
        'producer' => [
            'name' => 'producer',
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
                'reviewer' => [
                    'type' => 'select',
                    'default' => '',
                    'options' => [
                        ['value' => 'اصفهانی', 'label' => 'اصفهانی'],
                        ['value' => 'اسدی', 'label' => 'اسدی'],
                        ['value' => 'حیدری', 'label' => 'حیدری'],
                        ['value' => 'نعمتی', 'label' => 'نعمتی'],
                        ['value' => 'مقدسی', 'label' => 'مقدسی'],
                        ['value' => 'میرزایی', 'label' => 'میرزایی'],
                        ['value' => 'بام افکن', 'label' => 'بام افکن'],
                    ]
                ],
                'description' => ['type' => 'text', 'default' => '', 'required' => false],

            ],
            'memberships' => [
                '96' => ['membership_96', 'membership_96_pay_date', 'membership_96_ref_id', 'membership_96_pay_file'],
                '97' => ['membership_97', 'membership_97_pay_date', 'membership_97_ref_id', 'membership_97_pay_file'],
                '98' => ['membership_98', 'membership_98_pay_date', 'membership_98_ref_id', 'membership_98_pay_file'],
                '99' => ['membership_99', 'membership_99_pay_date', 'membership_99_ref_id', 'membership_99_pay_file'],
                '00' => ['membership_00', 'membership_00_pay_date', 'membership_00_ref_id', 'membership_00_pay_file'],
                '01' => ['membership_01', 'membership_01_pay_date', 'membership_01_ref_id', 'membership_01_pay_file'],
                '02' => ['membership_02', 'membership_02_pay_date', 'membership_02_ref_id', 'membership_02_pay_file'],
                'donate1' => ['donate1', 'donate1_pay_date', 'donate1_ref_id', 'donate1_pay_file'],
            ],
            'fin_fields' => [
                'fin_details' => ['type' => 'textarea'],
                'fin_green' => [
                    'type' => 'select',
                    'default' => '',
                    'options' => [
                        ['value' => 'not ok', 'label' => 'غیرفعال'],
                        ['value' => 'ok', 'label' => 'فعال'],
                    ]
                ],
                
            ],
            'debts' => [
                '1' => [ 'debt1', 'debt1_pay_date', 'debt1_ref_id', 'debt1_description' ],
            ],
            'docs' => [
                'national_card',
                'birth_certificate_image',
                'personal_image', 
            ]
        ],
        'unknown' => [
            'name' => 'unknown',
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
                'reviewer' => [
                    'type' => 'select',
                    'default' => '',
                    'options' => [
                        ['value' => 'اصفهانی', 'label' => 'اصفهانی'],
                        ['value' => 'اسدی', 'label' => 'اسدی'],
                        ['value' => 'حیدری', 'label' => 'حیدری'],
                        ['value' => 'نعمتی', 'label' => 'نعمتی'],
                        ['value' => 'مقدسی', 'label' => 'مقدسی'],
                        ['value' => 'میرزایی', 'label' => 'میرزایی'],
                        ['value' => 'بام افکن', 'label' => 'بام افکن'],
                    ]
                ],
                'description' => ['type' => 'text', 'default' => '', 'required' => false],


            ],
            'memberships' => [
                '96' => ['membership_96', 'membership_96_pay_date', 'membership_96_ref_id', 'membership_96_pay_file'],
                '97' => ['membership_97', 'membership_97_pay_date', 'membership_97_ref_id', 'membership_97_pay_file'],
                '98' => ['membership_98', 'membership_98_pay_date', 'membership_98_ref_id', 'membership_98_pay_file'],
                '99' => ['membership_99', 'membership_99_pay_date', 'membership_99_ref_id', 'membership_99_pay_file'],
                '00' => ['membership_00', 'membership_00_pay_date', 'membership_00_ref_id', 'membership_00_pay_file'],
                '01' => ['membership_01', 'membership_01_pay_date', 'membership_01_ref_id', 'membership_01_pay_file'],
                '02' => ['membership_02', 'membership_02_pay_date', 'membership_02_ref_id', 'membership_02_pay_file'],
                'donate1' => ['donate1', 'donate1_pay_date', 'donate1_ref_id', 'donate1_pay_file'],
            ],
            'fin_fields' => [
                'fin_details' => ['type' => 'textarea'],
                'fin_green' => [
                    'type' => 'select',
                    'default' => '',
                    'options' => [
                        ['value' => 'not ok', 'label' => 'غیرفعال'],
                        ['value' => 'ok', 'label' => 'فعال'],
                    ]
                ],
                
            ],
            'debts' => [
                '1' => [ 'debt1', 'debt1_pay_date', 'debt1_ref_id', 'debt1_description' ],
            ],
            'docs' => [
                'national_card',
                'birth_certificate_image',
                'personal_image', 
            ]
        ],
    ]
];
