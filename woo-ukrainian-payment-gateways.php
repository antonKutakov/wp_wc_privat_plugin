<?php

/**
 *
 * Plugin Name: Ukrainian payment gateways for Woocommerce
 * Description: Adds a Ukrainian payment gateways (Privat24) to Woocommerce
 * Author URI:  https://www.extrawest.com/
 * Author:      Extrawest
 * Version:     1.0.0
 *
 * Text Domain: woo-ukrainian-payment-gateways
 * Domain Path: /languages/
 *
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 *
 */


if(!(defined('ABSPATH'))){
    die; //Forbidden
}

define("WUPG_PATH", plugin_dir_url( __FILE__ ));
define("WUPG_DOMAIN", 'woo-ukrainian-payment-gateways');
define("WUPG_FILE_PREFIX", "wupg");

require plugin_dir_path( __FILE__ ) . 'vendor/autoload.php';


use WooUkrainianPaymentGateways\App\DB\WUPG_DB;
use WooUkrainianPaymentGateways\App\Loader;
use WooUkrainianPaymentGateways\App\Controllers;
add_filter( 'https_local_ssl_verify', '__return_true' );

register_activation_hook( __FILE__, "create_base_tables" );
register_deactivation_hook( __FILE__, "remove_base_tables_deactivation" );
register_uninstall_hook( __FILE__, "remove_base_tables_unistall" );

function remove_base_tables_deactivation(){
    (new WUPG_DB())->drop_table("privat24_merchant_balance");
    (new WUPG_DB())->drop_table("privat24_merchant_statement");
}

function remove_base_tables_unistall(){
    (new WUPG_DB())->drop_table("privat24_merchant_balance");
    (new WUPG_DB())->drop_table("privat24_merchant_statement");}

if( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ){
    add_action( "plugins_loaded", "base_init" );
    require_once plugin_dir_path( __FILE__ ) . 'app/woocommerce-extensions/privat-payments/wupg-privat-payment.php';
}
else{
    add_action( 'admin_notices', 'wupg_without_woo_notice' );

    function wupg_without_woo_notice() {
        ?>
        <div class="notice notice-warning is-dismissible">
            <p><?php echo __("Активируйте или установите Woocommerce чтобы получить способ оплаты 'Приват'!", 'woo-ukrainian-payment-gateways') ?></p>
        </div>
        <?php
    }
}

function base_init(){
    (new Loader())->wupg_load_dependencies();
}

require_once plugin_dir_path( __FILE__ ) . 'app/woocommerce-extensions/privat-payments/wupg-privat-payment.php';

function create_base_tables(){
    (new WUPG_DB())->create_table(
            "privat24_merchant_balance",
            "id int(11) AUTO_INCREMENT PRIMARY KEY,
            merchant_id int(11),
            account int(11),
            card_number varchar(255),
            acc_name varchar(255),
            acc_type varchar(255),
            currency varchar(255),
            card_type varchar(255),
            main_card_number int(11),
            av_balance float(11),
            bal_date datetime,
            balance float(11)",
            "IF NOT EXISTS"
        );
    (new WUPG_DB())->create_table(
            "privat24_merchant_statement",
            "id int(11) AUTO_INCREMENT PRIMARY KEY,
            merchant_id int(11),
            credit float(11),
            debit float(11),
            card varchar(255),
            statements varchar(255)",
            "IF NOT EXISTS"
        );

}

