<?php

namespace WooUkrainianPaymentGateways\App\Controllers\PrivatPayments;
use WooUkrainianPaymentGateways\App\Controller;
use WooUkrainianPaymentGateways\App\Controllers\PrivatPayments\PP_Account_Balance;
use WooUkrainianPaymentGateways\App\Controllers\PrivatPayments\PP_Account_Statements;
use WooUkrainianPaymentGateways\App\DB\WUPG_DB;
use WooUkrainianPaymentGateways\App\Render;
if(!defined('ABSPATH')){
    die;
}

/**
 * Core class of Privat Payments plugin
 */
class Privat_Payments extends Controller{

    private $menu_page;
    private $db;
    private $account_statement;
    private $account_balance;
    private $_wpdb;

    /**
     * Undocumented function
     *
     * @param [PP_Menu] $menu_page
     * @param [WUPG_DB] $db
     */
    public function __construct(){

        global $wpdb;

//        $this->menu_page = new PP_Menu();
        $this->db = new WUPG_DB();
        $this->account_statement = new PP_Account_Statements();
        $this->account_balance = new PP_Account_Balance();
        $this->_wpdb = $wpdb;
        
    }

    /**
     * Init hooks
     *
     * @return void
     */
    public function init(){

        add_action('admin_menu', array($this, 'pp_add_menu_options_page'));
        add_action('wp_ajax_save_settings', array($this, 'pp_save_settings'));
        add_action('wp_ajax_take_statements', array($this, 'pp_ajax_take_statements'));
        add_action('wp_ajax_take_balance', array($this, 'pp_ajax_take_balance'));
        add_action('wp_ajax_take_balance_arch', array($this, 'pp_ajax_take_balance_arch'));

    }

    /**
     * Add menu pages
     *
     * @return void
     */
    public function pp_add_menu_options_page(){

        add_menu_page(
            'Privat24 Payments',
            'Privat24 Payments',
            'manage_options',
            'privat24_payments',
            array($this, 'pp_send_main_render_attributes'),
            WUPG_PATH  . '/assets/images/privat-favicon.ico',
            4
        );

        add_submenu_page(
            'privat24_payments',
            'Balance',
            'Balance',
            'manage_options',
            'balance',
            array($this, 'pp_send_balance_render_attributes')
        );

        add_submenu_page(
            'privat24_payments',
            'Statements',
            'Statements',
            'manage_options',
            'statements',
            array($this, 'pp_send_statements_render_attributes')
        );

    }

    /**
     * Render menu page and send data into view
     *
     * @return void
     */
    public function pp_send_main_render_attributes(){

        $result = get_option("woocommerce_privat_payments_gateway_settings");
        Render::make('settings',$result,'privat-payments');

    }

    /**
     * Render balance page and send data into view
     *
     * @return void
     */
    public function pp_send_balance_render_attributes(){

        Render::make('balance-options',array(),'privat-payments');

    }

    /**
     * Render statements page and send data into view
     *
     * @return void
     */
    public function pp_send_statements_render_attributes(){

        Render::make('statements-options',array(),'privat-payments');

    }

    /**
     * Ajax callback for save settings
     *
     * @return void
     */
    public function pp_save_settings(){

        $settings = get_option( "woocommerce_privat_payments_gateway_settings");

        $merchant_id = sanitize_text_field($_POST['merchant_id']);
        $password = sanitize_text_field($_POST['password']);
        $wait = sanitize_text_field($_POST['wait']);
        $cardnum = sanitize_text_field($_POST['cardnum']);
        $country = sanitize_text_field($_POST['country']);
        $title = sanitize_text_field($_POST['title']);
        $desc = sanitize_text_field($_POST['description']);
        $enabled = (sanitize_text_field($_POST['enabled']) == 1) ? "yes" : "no";

        $data = array(
            'merchant_id' => $merchant_id,
            'wait' => $wait,
            'cardnum' => $cardnum,
            'country' => $country,
            'password' => $password,
            'title' => $title,
            'description' => $desc,
            'enabled' => $enabled
        );   

        update_option("woocommerce_privat_payments_gateway_settings", $data);

        echo json_encode($intersect);

        wp_die();

    }

    /**
     * Ajax callback for taking statements
     *
     * @return void
     */
    public function pp_ajax_take_statements(){

        $result = get_option("woocommerce_privat_payments_gateway_settings");

        echo $this->account_statement->pp_take_statements($result, $this->db);

        wp_die();

    }

    public function pp_ajax_take_balance(){

        $result = get_option("woocommerce_privat_payments_gateway_settings");

        echo $this->account_balance->pp_take_balance($result, $this->db);

        wp_die();
        
    }

    /**
     * Ajax callback for taking balance archive
     *
     * @return void
     */

    public function pp_ajax_take_balance_arch(){
        global $wpdb;

        $data = "*";
        $from = $wpdb->prefix . "privat24_merchant_balance";

        $result = $this->db->get_data($data, $from);

        echo $this->account_balance->pp_take_balance_arch($result, $this->db);

        wp_die();
    }

}