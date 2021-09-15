<?php

use WooUkrainianPaymentGateways\App\DB\WUPG_DB;

add_action( 'plugins_loaded', 'init_privat_payments_class' );
function init_privat_payments_class() {

    if(!class_exists("WC_Gateway_Privat_Payments_Gateway")){

        class WC_Gateway_Privat_Payments_Gateway extends WC_Payment_Gateway {

            public function __construct(){

                $this->id = 'privat_payments_gateway';
                $this->icon = WUPG_PATH  . '/assets/images/privat-logo.svg';
                $this->has_fields = true;
                $this->method_title = "Privat 24 payments";
                $this->method_description = "Privat 24 payments";
                $this->liveurl = "https://api.privatbank.ua/p24api/ishop";

                $this->form_fields = array(
                    'enabled' => array(
                        'title' => __( 'Enable/Disable', 'woocommerce' ),
                        'type' => 'checkbox',
                        'label' => __( 'Enable Cheque Payment', 'woocommerce' ),
                        'default' => 'yes'
                    ),
                    'title' => array(
                        'title' => __( 'Title', 'woocommerce' ),
                        'type' => 'text',
                        'description' => __( 'This controls the title which the user sees during checkout.', 'woocommerce' ),
                        'default' => __( 'Cheque Payment', 'woocommerce' ),
                        'desc_tip'      => true,
                    ),
                    'description' => array(
                        'title' => __( 'Customer Message', 'woocommerce' ),
                        'type' => 'textarea',
                        'default' => 'Success!'
                    ),
                    'merchant_id' => array(
                        'title' => __('Privat 24 Id', 'woocommerce'),
                        'type' => 'text',
                        'default' => '000000'
                    ),
                    'password' => array(
                        'title' => __('Privat 24 Secret Key', 'woocommerce'),
                        'type' => 'text',
                        'default' => '95P2D9nj1f6B5OvE07L29v4Tsr8rjqD0'
                    ),
                    'cardnum' => array(
                        'title' => __('Card Number', 'woocommerce'),
                        'type' => 'text',
                        'default' => '5555555555554444'
                    ),
                    'wait' => array(
                        'title' => __('Waiting time', 'woocommerce'),
                        'type' => 'text',
                        'default' => '20'
                    ),
                    'country' => array(
                        'title' => __('Country', 'woocommerce'),
                        'type' => 'text',
                        'default' => 'UA'
                    ),
                );

                $this->init_form_fields();
                $this->init_settings();
                $this->title = $this->settings['title'];
                $this->description = $this->settings['description'];
                $this->privat_id = $this->settings['merchant_id'];
                $this->privat_card_number = $this->settings['cardnum'];
                $this->privat_secret_key = $this->settings['password'];
                $this->privat_wait_time = $this->settings['wait'];

                if ( version_compare( WOOCOMMERCE_VERSION, '2.0.0', '>=' ) ) {
                    add_action( 'woocommerce_update_options_payment_gateways_' . $this->id, array( &$this, 'process_admin_options' ) );
                } else {
                    add_action( 'woocommerce_update_options_payment_gateways', array( &$this, 'process_admin_options' ) );
                }

                add_action( 'woocommerce_receipt_'. $this->id, array( $this, 'receipt_page' ) );
                add_action('woocommerce_api_privat_payments', array( $this, 'check_response'));

            }

            public function admin_options() {
                ?>
                <h2><?php _e('Privat 24 Payments','woocommerce'); ?></h2>
                <table class="form-table">
                    <?php
                    $this->generate_settings_html();
                    ?>
                </table>
                <?php
            }

            public function process_payment($order_id){

                $order = new WC_Order($order_id);
                return array(
                    'result' => 'success',
                    'redirect'  => add_query_arg('order', $order->id, add_query_arg('key', $order->order_key, get_permalink(woocommerce_get_page_id('pay'))))
                );

            }

            public function receipt_page($order){

                echo '<p>'.__('Спасибо за Ваш заказ, пожалуйста, нажмите кнопку ниже, чтобы заплатить.', 'woocommerce').'</p>';
                echo $this->generate_form($order);

            }

            public function generate_form($order_id){

                $order = new WC_Order( $order_id );
                $action_adr = $this->liveurl;
                $result_url = str_replace( 'https:', 'http:', add_query_arg( 'wc-api', 'privat_payments', get_permalink(wc_get_page_id('thanks')) ) );
                $args = array(
                    'amt'         => $order->get_total(),
                    'ccy'         => get_woocommerce_currency(),
                    'merchant'    => $this->privat_id,
                    'order'       => $order_id,
                    'details'     => "Оплата за заказ - $order_id",
                    'ext_details' => "Оплата за заказ - $order_id",
                    'pay_way'     => 'privat24',
                    'return_url'  => $result_url,
                    'server_url'  => '',
                );

                $args_array = array();

                foreach ($args as $key => $value){
                    $args_array[] = '<input type="hidden" name="'.esc_attr($key).'" value="'.esc_attr($value).'" />';
                }

                return
                    '<form action="'.esc_url($action_adr).'" method="POST" id="privat24_payment_form">'.
                    '<input type="submit" class="button alt" id="submit_privat24_button" value="'.__('Оплатить', 'woocommerce').'" /> <a class="button cancel" href="'.$order->get_cancel_order_url().'">'.__('Отказаться от оплаты & вернуться в корзину', 'woocommerce').'</a>'."\n".
                    implode("\n", $args_array).
                    '</form>';

            }


            public function check_response(){

                global $woocommerce;

                $posted = $_POST['payment'];
                $hash = sha1(md5($posted.$this->privat_secret_key));

                if (isset($_POST['payment']) && $hash === $_POST['signature']){

                    $items=explode("&", $_POST['payment']);
                    $ar=array();

                    foreach($items as $it){

                        $key=""; $value="";
                        list($key, $value)=explode("=", $it, 2);
                        $payment_items[$key]=$value;

                    }

                    $order = new WC_Order($payment_items['order']);
                    $order->update_status('completed', __('Платеж успешно оплачен', 'woocommerce'));
                    $order->add_order_note( __('Клиент успешно оплатил заказ', 'woocommerce') );

                    $woocommerce->cart->empty_cart();

                    wp_redirect(home_url(), 301);
                    exit;

                }
                else{
                    wp_die('IPN Request Failure');
                }

            }

        }
        function add_privat_payments_class( $methods ) {

            $methods[] = 'WC_Gateway_Privat_Payments_Gateway';
            return $methods;

        }
        add_filter( 'woocommerce_payment_gateways', 'add_privat_payments_class' );


    }

}

