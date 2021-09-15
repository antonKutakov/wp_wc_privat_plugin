<?php

namespace WooUkrainianPaymentGateways\App\Controllers\PrivatPayments;

use WooUkrainianPaymentGateways\App\Controller;
use WooUkrainianPaymentGateways\App\DB\WUPG_DB;
use WooUkrainianPaymentGateways\App\Helpers\PP_Response_Helper;
use WooUkrainianPaymentGateways\App\Helpers\PP_XML_Request;
use WooUkrainianPaymentGateways\App\Helpers\PP_Build_XML_Helper;

if(!defined('ABSPATH')){
    die;
}

/**
 * Class for component Account Balance
 */
class PP_Account_Balance extends Controller {
    /**
     * Taking balance
     *
     */

    public function pp_take_balance($data = null, $db){
        global $wpdb;

        $xml_args = array(
            'merchant_id' => $data['merchant_id'],
            'password' => $data['password'],
            'payment_id' => sha1(md5(rand(10, 11))),
            'card' => $data['cardnum'],
            'country' => $data['country'],
            'wait' => $data['wait']
        );


        $xml = PP_Build_XML_Helper::pp_build_balance_xml($xml_args);

        $response = PP_XML_Request::pp_make_xml_request("https://api.privatbank.ua/p24api/balance", $xml);

        $bal = new \SimpleXMLElement($response);
        $bal_list = $bal->data->info->cardbalance;
        $bal_list_items =  $bal_list->children();

        $table = $wpdb->prefix.'privat24_merchant_balance';


        $format = array(
            '%d',
            '%f',
            '%s',
            '%s',
            '%f',
            '%s',
            '%s'
        );


        $date = date("Y-m-d H:i:s");

        $results = $wpdb->get_results("SELECT * FROM wp_privat24_merchant_balance");

        $db_balance = $results->balance;
        $db_date = $results->bal_date;

        $db_data =array(
            'merchant_id' => $xml_args['merchant_id'],
            'balance' => $bal_list_items->balance,
            'currency' => $bal_list_items->card->currency,
            'bal_date' => $date,
            'av_balance' => $bal_list_items->av_balance,
            'account' => $bal_list_items->card->account,
            'card_number' => $bal_list_items->card->card_number
        );


        if($db_balance != $db_data['balance'] && $db_date != $db_data['bal_date']  ) {
            $db->insert_data($table, $db_data, $format);

        }else {
            echo json_encode(array(
                'code' => 0, //Precondition Failed
                'message' => 'Error, empty data'
            ));
            wp_die();
        }

        return PP_Response_Helper::pp_json_response(200, 'Ok', json_encode($bal_list_items));

        wp_die();

    }

    public function pp_take_balance_arch(){
        global $wpdb;

        $results = $wpdb->get_results("SELECT * FROM wp_privat24_merchant_balance");

        $data = array();

        for($i = 0; $i < count($results); $i++){
            $data[$i] = array(
                'balance' => $results[$i]->balance,
                'currency' => $results[$i]->currency,
                'bal_date' => $results[$i]->bal_date,
                'av_balance' => $results[$i]->av_balance,
                'account' => $results[$i]->account,
                'card_number' => $results[$i]->card_number
            );
        }

        if(count($results) == 0){
            echo json_encode(array(
                'code' => 0, //Precondition Failed
                'message' => 'Error, empty data'
            ));
            wp_die();
        }else{
            return PP_Response_Helper::pp_json_response(200, 'Ok', json_encode($data));

            wp_die();
        }


        wp_die();
    }



}