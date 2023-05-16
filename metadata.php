<?php

/**
 * Metadata version
 */
$sMetadataVersion = '2.0';

/**
 * Module information
 */
$aModule = [
    'id'            => 'gingerpayments',
    'title'         => [
        'de' => 'Ginger Payment',
        'en' => 'Ginger Payment',
        'fr' => 'Ginger Payment'
    ],
    'description'   => [
        'de' => 'Ginger Payments DE',
        'en' =>'Ginger Payments EN',
        'fr' => 'Ginger Payments FR',
        'nl' => 'Ginger Payments NL',
    ],
    'thumbnail'    => 'gingerpayments_logo.png',
    'version'       => '1.0.0',
    'author'        => 'Ginger Payments',
    'email'         => 'bogdan.shevchenko@leasoft.org',
    'url'          => 'https://merchant.dev.gingerpayments.com/',
    'extend' => [
        \OxidEsales\Eshop\Application\Model\Order::class => \GingerPayments\Order\ModuleOrder::class,
        \OxidEsales\Eshop\Application\Controller\PaymentController::class => \GingerPayments\Controller\ModulePaymentController::class,
    ],
    'controllers' => [
        'ModuleSettings' => \GingerPayments\Controller\ModuleSettingsController::class,
    ],
    'templates' => [
        'ginger_payments_module_settings.tpl' => 'ginger_payments_module/views/admin/ginger_payments_module_settings.tpl',
    ],
];
