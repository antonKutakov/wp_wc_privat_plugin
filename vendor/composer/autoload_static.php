<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit128ded5713a7cbd266af01514bff5cb6
{
    public static $prefixLengthsPsr4 = array (
        'W' => 
        array (
            'WooUkrainianPaymentGateways\\App\\Renders\\PrivatPayments\\' => 55,
            'WooUkrainianPaymentGateways\\App\\Renders\\' => 40,
            'WooUkrainianPaymentGateways\\App\\Models\\' => 39,
            'WooUkrainianPaymentGateways\\App\\Helpers\\PrivatPayments\\' => 55,
            'WooUkrainianPaymentGateways\\App\\Helpers\\' => 40,
            'WooUkrainianPaymentGateways\\App\\Controllers\\PrivatPayments\\' => 59,
            'WooUkrainianPaymentGateways\\App\\' => 32,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'WooUkrainianPaymentGateways\\App\\Renders\\PrivatPayments\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app/renders/privat-payments',
        ),
        'WooUkrainianPaymentGateways\\App\\Renders\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app/renders',
        ),
        'WooUkrainianPaymentGateways\\App\\Models\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app/models',
        ),
        'WooUkrainianPaymentGateways\\App\\Helpers\\PrivatPayments\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app/helpers/privat-payments',
        ),
        'WooUkrainianPaymentGateways\\App\\Helpers\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app/helpers',
        ),
        'WooUkrainianPaymentGateways\\App\\Controllers\\PrivatPayments\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app/controllers/privat-payments',
        ),
        'WooUkrainianPaymentGateways\\App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'WooUkrainianPaymentGateways\\App\\Controller' => __DIR__ . '/../..' . '/app/Controller.php',
        'WooUkrainianPaymentGateways\\App\\Controllers\\PrivatPayments\\PP_Account_Balance' => __DIR__ . '/../..' . '/app/controllers/privat-payments/wupg-privat-payments-account-balance.php',
        'WooUkrainianPaymentGateways\\App\\Controllers\\PrivatPayments\\PP_Account_Statements' => __DIR__ . '/../..' . '/app/controllers/privat-payments/wupg-privat-payments-account-statements.php',
        'WooUkrainianPaymentGateways\\App\\Controllers\\PrivatPayments\\Privat_Payments' => __DIR__ . '/../..' . '/app/controllers/privat-payments/wupg-privat-payments.php',
        'WooUkrainianPaymentGateways\\App\\DB\\WUPG_DB' => __DIR__ . '/../..' . '/app/DB/wupg-db.php',
        'WooUkrainianPaymentGateways\\App\\Helper' => __DIR__ . '/../..' . '/app/Helper.php',
        'WooUkrainianPaymentGateways\\App\\Helpers\\PP_Build_XML_Helper' => __DIR__ . '/../..' . '/app/helpers/privat-payments/wupg-privat-build-xml-helper.php',
        'WooUkrainianPaymentGateways\\App\\Helpers\\PP_Response_Helper' => __DIR__ . '/../..' . '/app/helpers/privat-payments/wupg-privat-response-helper.php',
        'WooUkrainianPaymentGateways\\App\\Helpers\\PP_XML_Request' => __DIR__ . '/../..' . '/app/helpers/privat-payments/wupg-privat-xml-request.php',
        'WooUkrainianPaymentGateways\\App\\Loader' => __DIR__ . '/../..' . '/app/Loader.php',
        'WooUkrainianPaymentGateways\\App\\Model' => __DIR__ . '/../..' . '/app/Model.php',
        'WooUkrainianPaymentGateways\\App\\Models\\WUPG_Settings_Model' => __DIR__ . '/../..' . '/app/models/wupg-settings-model.php',
        'WooUkrainianPaymentGateways\\App\\Render' => __DIR__ . '/../..' . '/app/Render.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit128ded5713a7cbd266af01514bff5cb6::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit128ded5713a7cbd266af01514bff5cb6::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit128ded5713a7cbd266af01514bff5cb6::$classMap;

        }, null, ClassLoader::class);
    }
}
