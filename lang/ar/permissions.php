<?php


return [

    'roles' => [
        'name' => 'الصلاحيات',
        'perm' => [
            'manage_roles' => 'ادارة الأدوار والصلاحيات',
        ]
    ],
    'admins' => [
        'name' => 'المدراء',
        'perm' => [
            'add_admins' => 'اضافة مدير',
            'show_admins' => 'عرض مدير',
        ]
    ],
    'help_center' => [
        'name' => 'ادارة مركز المساعدة',
        'perm' => [
            'manage_inbox' => 'ادارة صندوق الوارد',
        ]
    ],
    'constants' => [
        'name' => 'ثوابت الموقع',
        'perm' => [
            'manage_pages' => 'ادارة صفحات الموقع',
            'manage_blogs' => 'ادارة المقالات',
            'manage_faq' => 'ادارة الأسئلة الشائعة',
            'manage_settings' => 'ادارة الإعدادات',
        ]
    ],

];

