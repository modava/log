<?php
use modava\log\LogModule;

return [
    'availableLocales' => [
        'vi' => 'Tiếng Việt',
        'en' => 'English',
        'jp' => 'Japan',
    ],
    'logName' => 'Log',
    'logVersion' => '1.0',
    'status' => [
        '0' => LogModule::t('log', 'Tạm ngưng'),
        '1' => LogModule::t('log', 'Hiển thị'),
    ]
];
