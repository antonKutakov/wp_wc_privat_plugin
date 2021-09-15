<?php

namespace WooUkrainianPaymentGateways\App;
use WooUkrainianPaymentGateways\App\Controllers\PrivatPayments\Privat_Payments;
use WooUkrainianPaymentGateways\App\Controllers\PrivatPayments\PP_Account_Balance;
use WooUkrainianPaymentGateways\App\Controllers\PrivatPayments\PP_Account_Statements;
/**
 * Class for loading scripts, styles and dependencies
 */
class Loader{

    public function __construct(){
        add_action('admin_enqueue_scripts', array($this, 'wupg_load_scripts'));
        add_action('wp_enqueue_scripts', array($this, 'wupg_load_scripts'));
    }

    /**
     * Loading scripts
     *
     * @return void
     */
    public function wupg_load_scripts(){
        wp_enqueue_style('tr_style', WUPG_PATH  . '/assets/css/style.css');
        wp_enqueue_script('tr_script', WUPG_PATH . '/assets/js/main.js', array(), false, true);
        wp_localize_script('pp-ajax', 'ajaxurl', array(
            'url' => admin_url('admin-ajax.php'),
            'ajax_nonce' => wp_create_nonce('ajax_pp_form_nonce'),
        ));
    }

    /**
     * Loading controllers
     *
     * @return void
     */
    public function wupg_load_dependencies(){
        (new Privat_Payments())->init();
//        (new PP_Account_Balance())->init();
//        (new PP_Account_Statements())->init();
    }

}