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
                'guild_catagory' => ['type' => 'text', 'disabled' => true, 'default' => 'شارژ سیلندرهای آتش نشانی', 'required' => false],
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
                'status' => ['type' => 'text', 'default' => '', 'disabled' => true],
                'new_status' => [
                    'type' => 'select',
                    'default' => '',
                    'options' => [
                        ['value' => 'جدید', 'label' => 'جدید'],
                        ['value' => 'درحال بررسی', 'label' => 'در حال بررسی'],
                        ['value' => 'در حال تکمیل', 'label' => 'در حال تکمیل'],
                        ['value' => 'صادر شده', 'label' => 'صادر شده'],
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
                '96' => ['membership96', 'membership96_pay_date', 'membership96_ref_id', 'membership96_pay_file'],
                '97' => ['membership97', 'membership97_pay_date', 'membership97_ref_id', 'membership97_pay_file'],
                '98' => ['membership98', 'membership98_pay_date', 'membership98_ref_id', 'membership98_pay_file'],
                '99' => ['membership99', 'membership99_pay_date', 'membership99_ref_id', 'membership99_pay_file'],
                '00' => ['membership00', 'membership00_pay_date', 'membership00_ref_id', 'membership00_pay_file'],
                '01' => ['membership01', 'membership01_pay_date', 'membership01_ref_id', 'membership01_pay_file'],
                '02' => ['membership02', 'membership02_pay_date', 'membership02_ref_id', 'membership02_pay_file'],
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
                'education_degree',
                'military_card',
                'business_rules_certificate',
                'lease_or_ownership_doc',
                'partner_consent_letter',
                'tax',
                'nitrogen_cylinder_hidrostatic_test_certificate',
                'pressure_gauge_calibration_certificate',
                'weightbridge_calibration_certificate',
                'gas_storage_tank_certificate',
                'commitment',
                'revoke_business_license_form',
                'previous_business_license',
                'postal_code_certificate'
            ]
        ],
        'retail' => [
            'name' => 'retail',
            'catagory_fa' => 'خرده فروشی گازهای طبی و صنعتی',
            'fields' => [
                'file_number' => ['type' => 'text', 'required' => true],
                'guild_catagory' => ['type' => 'text', 'disabled' => true, 'default' => 'خرده فروشی گازهای طبی و صنعتی', 'required' => false],
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
                'status' => ['type' => 'text', 'default' => '', 'disabled' => true],
                'new_status' => [
                    'type' => 'select',
                    'default' => '',
                    'options' => [
                        ['value' => 'جدید', 'label' => 'جدید'],
                        ['value' => 'درحال بررسی', 'label' => 'در حال بررسی'],
                        ['value' => 'در حال تکمیل', 'label' => 'در حال تکمیل'],
                        ['value' => 'صادر شده', 'label' => 'صادر شده'],
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
                '96' => ['membership96', 'membership96_pay_date', 'membership96_ref_id', 'membership96_pay_file'],
                '97' => ['membership97', 'membership97_pay_date', 'membership97_ref_id', 'membership97_pay_file'],
                '98' => ['membership98', 'membership98_pay_date', 'membership98_ref_id', 'membership98_pay_file'],
                '99' => ['membership99', 'membership99_pay_date', 'membership99_ref_id', 'membership99_pay_file'],
                '00' => ['membership00', 'membership00_pay_date', 'membership00_ref_id', 'membership00_pay_file'],
                '01' => ['membership01', 'membership01_pay_date', 'membership01_ref_id', 'membership01_pay_file'],
                '02' => ['membership02', 'membership02_pay_date', 'membership02_ref_id', 'membership02_pay_file'],
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
                'education_degree',
                'military_card',
                'business_rules_certificate',
                'lease_or_ownership_doc',
                'partner_consent_letter',
                'tax',
                'nitrogen_cylinder_hidrostatic_test_certificate',
                'pressure_gauge_calibration_certificate',
                'weightbridge_calibration_certificate',
                'gas_storage_tank_certificate',
                'commitment',
                'revoke_business_license_form',
                'previous_business_license',
                'postal_code_certificate'
            ]
        ],
        'sale-and-charging-insdustrial-gas' => [
            'name' => 'sale and charging insdustrial gas',
            'catagory_fa' => 'شارژ و فروش گازهای طبی و صنعتی',
            'fields' => [
                'file_number' => ['type' => 'text', 'required' => true],
                'guild_catagory' => ['type' => 'text', 'disabled' => true, 'default' => 'شارژ و فروش گازهای طبی و صنعتی', 'required' => false],
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
                'status' => ['type' => 'text', 'default' => '', 'disabled' => true],
                'new_status' => [
                    'type' => 'select',
                    'default' => '',
                    'options' => [
                        ['value' => 'جدید', 'label' => 'جدید'],
                        ['value' => 'درحال بررسی', 'label' => 'در حال بررسی'],
                        ['value' => 'در حال تکمیل', 'label' => 'در حال تکمیل'],
                        ['value' => 'صادر شده', 'label' => 'صادر شده'],
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
                '96' => ['membership96', 'membership96_pay_date', 'membership96_ref_id', 'membership96_pay_file'],
                '97' => ['membership97', 'membership97_pay_date', 'membership97_ref_id', 'membership97_pay_file'],
                '98' => ['membership98', 'membership98_pay_date', 'membership98_ref_id', 'membership98_pay_file'],
                '99' => ['membership99', 'membership99_pay_date', 'membership99_ref_id', 'membership99_pay_file'],
                '00' => ['membership00', 'membership00_pay_date', 'membership00_ref_id', 'membership00_pay_file'],
                '01' => ['membership01', 'membership01_pay_date', 'membership01_ref_id', 'membership01_pay_file'],
                '02' => ['membership02', 'membership02_pay_date', 'membership02_ref_id', 'membership02_pay_file'],
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
                'education_degree',
                'military_card',
                'business_rules_certificate',
                'lease_or_ownership_doc',
                'partner_consent_letter',
                'tax',
                'nitrogen_cylinder_hidrostatic_test_certificate',
                'pressure_gauge_calibration_certificate',
                'weightbridge_calibration_certificate',
                'gas_storage_tank_certificate',
                'commitment',
                'revoke_business_license_form',
                'previous_business_license',
                'postal_code_certificate'
            ]
        ],
        'saling-fire-cylenders' => [
            'name' => 'saling fire cylenders',
            'catagory_fa' => 'فروش سیلندرهای آتش نشانی',
            'fields' => [
                'file_number' => ['type' => 'text', 'required' => true],
                'guild_catagory' => ['type' => 'text', 'disabled' => true, 'default' => 'فروش سیلندرهای آتش نشانی', 'required' => false],
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
                'status' => ['type' => 'text', 'default' => '', 'disabled' => true],
                'new_status' => [
                    'type' => 'select',
                    'default' => '',
                    'options' => [
                        ['value' => 'جدید', 'label' => 'جدید'],
                        ['value' => 'درحال بررسی', 'label' => 'در حال بررسی'],
                        ['value' => 'در حال تکمیل', 'label' => 'در حال تکمیل'],
                        ['value' => 'صادر شده', 'label' => 'صادر شده'],
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
                '96' => ['membership96', 'membership96_pay_date', 'membership96_ref_id', 'membership96_pay_file'],
                '97' => ['membership97', 'membership97_pay_date', 'membership97_ref_id', 'membership97_pay_file'],
                '98' => ['membership98', 'membership98_pay_date', 'membership98_ref_id', 'membership98_pay_file'],
                '99' => ['membership99', 'membership99_pay_date', 'membership99_ref_id', 'membership99_pay_file'],
                '00' => ['membership00', 'membership00_pay_date', 'membership00_ref_id', 'membership00_pay_file'],
                '01' => ['membership01', 'membership01_pay_date', 'membership01_ref_id', 'membership01_pay_file'],
                '02' => ['membership02', 'membership02_pay_date', 'membership02_ref_id', 'membership02_pay_file'],
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
                'education_degree',
                'military_card',
                'business_rules_certificate',
                'lease_or_ownership_doc',
                'partner_consent_letter',
                'tax',
                'nitrogen_cylinder_hidrostatic_test_certificate',
                'pressure_gauge_calibration_certificate',
                'weightbridge_calibration_certificate',
                'gas_storage_tank_certificate',
                'commitment',
                'revoke_business_license_form',
                'previous_business_license',
                'postal_code_certificate'
            ]
        ],
        'wholesaling-industrial-gas' => [
            'name' => 'wholesaling industrial gas',
            'catagory_fa' => 'عمده فروشی گازهای طبی و صنعتی',
            'fields' => [
                'file_number' => ['type' => 'text', 'required' => true],
                'guild_catagory' => ['type' => 'text', 'disabled' => true, 'default' => 'عمده فروشی گازهای طبی و صنعتی', 'required' => false],
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
                'status' => ['type' => 'text', 'default' => '', 'disabled' => true],
                'new_status' => [
                    'type' => 'select',
                    'default' => '',
                    'options' => [
                        ['value' => 'جدید', 'label' => 'جدید'],
                        ['value' => 'درحال بررسی', 'label' => 'در حال بررسی'],
                        ['value' => 'در حال تکمیل', 'label' => 'در حال تکمیل'],
                        ['value' => 'صادر شده', 'label' => 'صادر شده'],
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
                '96' => ['membership96', 'membership96_pay_date', 'membership96_ref_id', 'membership96_pay_file'],
                '97' => ['membership97', 'membership97_pay_date', 'membership97_ref_id', 'membership97_pay_file'],
                '98' => ['membership98', 'membership98_pay_date', 'membership98_ref_id', 'membership98_pay_file'],
                '99' => ['membership99', 'membership99_pay_date', 'membership99_ref_id', 'membership99_pay_file'],
                '00' => ['membership00', 'membership00_pay_date', 'membership00_ref_id', 'membership00_pay_file'],
                '01' => ['membership01', 'membership01_pay_date', 'membership01_ref_id', 'membership01_pay_file'],
                '02' => ['membership02', 'membership02_pay_date', 'membership02_ref_id', 'membership02_pay_file'],
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
                'education_degree',
                'military_card',
                'business_rules_certificate',
                'lease_or_ownership_doc',
                'partner_consent_letter',
                'tax',
                'nitrogen_cylinder_hidrostatic_test_certificate',
                'pressure_gauge_calibration_certificate',
                'weightbridge_calibration_certificate',
                'gas_storage_tank_certificate',
                'commitment',
                'revoke_business_license_form',
                'previous_business_license',
                'postal_code_certificate'
            ]
        ],
        'producer' => [
            'name' => 'producer',
            'catagory_fa' => 'تولیدکننده',
            'fields' => [
                'file_number' => ['type' => 'text', 'required' => true],
                'guild_catagory' => ['type' => 'text', 'disabled' => true, 'default' => 'تولیدکننده', 'required' => false],
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
                'status' => ['type' => 'text', 'default' => '', 'disabled' => true],
                'new_status' => [
                    'type' => 'select',
                    'default' => '',
                    'options' => [
                        ['value' => 'جدید', 'label' => 'جدید'],
                        ['value' => 'درحال بررسی', 'label' => 'در حال بررسی'],
                        ['value' => 'در حال تکمیل', 'label' => 'در حال تکمیل'],
                        ['value' => 'صادر شده', 'label' => 'صادر شده'],
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
                '96' => ['membership96', 'membership96_pay_date', 'membership96_ref_id', 'membership96_pay_file'],
                '97' => ['membership97', 'membership97_pay_date', 'membership97_ref_id', 'membership97_pay_file'],
                '98' => ['membership98', 'membership98_pay_date', 'membership98_ref_id', 'membership98_pay_file'],
                '99' => ['membership99', 'membership99_pay_date', 'membership99_ref_id', 'membership99_pay_file'],
                '00' => ['membership00', 'membership00_pay_date', 'membership00_ref_id', 'membership00_pay_file'],
                '01' => ['membership01', 'membership01_pay_date', 'membership01_ref_id', 'membership01_pay_file'],
                '02' => ['membership02', 'membership02_pay_date', 'membership02_ref_id', 'membership02_pay_file'],
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
                'education_degree',
                'military_card',
                'business_rules_certificate',
                'lease_or_ownership_doc',
                'partner_consent_letter',
                'tax',
                'nitrogen_cylinder_hidrostatic_test_certificate',
                'pressure_gauge_calibration_certificate',
                'weightbridge_calibration_certificate',
                'gas_storage_tank_certificate',
                'commitment',
                'revoke_business_license_form',
                'previous_business_license',
                'postal_code_certificate'
            ]
        ],
        'unknown' => [
            'name' => 'unknown',
            'catagory_fa' => 'بدون رسته',
            'fields' => [
                'file_number' => ['type' => 'text', 'required' => true],
                'guild_catagory' => ['type' => 'text', 'disabled' => true, 'default' => 'بدون رسته', 'required' => false],
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
                'status' => ['type' => 'text', 'default' => '', 'disabled' => true],
                'new_status' => [
                    'type' => 'select',
                    'default' => '',
                    'options' => [
                        ['value' => 'جدید', 'label' => 'جدید'],
                        ['value' => 'درحال بررسی', 'label' => 'در حال بررسی'],
                        ['value' => 'در حال تکمیل', 'label' => 'در حال تکمیل'],
                        ['value' => 'صادر شده', 'label' => 'صادر شده'],
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
                '96' => ['membership96', 'membership96_pay_date', 'membership96_ref_id', 'membership96_pay_file'],
                '97' => ['membership97', 'membership97_pay_date', 'membership97_ref_id', 'membership97_pay_file'],
                '98' => ['membership98', 'membership98_pay_date', 'membership98_ref_id', 'membership98_pay_file'],
                '99' => ['membership99', 'membership99_pay_date', 'membership99_ref_id', 'membership99_pay_file'],
                '00' => ['membership00', 'membership00_pay_date', 'membership00_ref_id', 'membership00_pay_file'],
                '01' => ['membership01', 'membership01_pay_date', 'membership01_ref_id', 'membership01_pay_file'],
                '02' => ['membership02', 'membership02_pay_date', 'membership02_ref_id', 'membership02_pay_file'],
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
                'education_degree',
                'military_card',
                'business_rules_certificate',
                'lease_or_ownership_doc',
                'partner_consent_letter',
                'tax',
                'nitrogen_cylinder_hidrostatic_test_certificate',
                'pressure_gauge_calibration_certificate',
                'weightbridge_calibration_certificate',
                'gas_storage_tank_certificate',
                'commitment',
                'revoke_business_license_form',
                'previous_business_license',
                'postal_code_certificate'
            ]
        ],
    ]
];
