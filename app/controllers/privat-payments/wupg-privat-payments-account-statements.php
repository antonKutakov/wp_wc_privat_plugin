<?php

namespace WooUkrainianPaymentGateways\App\Controllers\PrivatPayments;

use WooUkrainianPaymentGateways\App\Controller;
use WooUkrainianPaymentGateways\App\Helpers\PP_Response_Helper;
use WooUkrainianPaymentGateways\App\Helpers\PP_XML_Request;
use WooUkrainianPaymentGateways\App\Helpers\PP_Build_XML_Helper;

if(!defined('ABSPATH')){
    die;
}

/**
 * Class of component Account Statements
 */
class PP_Account_Statements extends Controller {


    /**
     * Taking statements
     *
     * @param [array] $data
     * @param [WUPG_DB] $db
     * @return void
     */
    public function pp_take_statements($data = null, $db){

        global $wpdb;

        if(empty($_POST['sd'] && $_POST['ed'])){
            echo json_encode(array(
                'code' => 412, //Precondition Failed 
                'message' => 'Error, empty data'
            ));
            wp_die();
        }
        elseif(strtotime($_POST['ed']) < strtotime($_POST['sd'])){
            echo json_encode(array(
                'code' => 412, //Precondition Failed 
                'message' => 'Error, end date is bigger then start date'
            ));
            wp_die();
        }        
        else{
            $sd = sanitize_text_field( $_POST['sd'] );
            $ed = sanitize_text_field( $_POST['ed'] );
            
            $sd = date('d.m.Y',strtotime($sd));
            $ed = date('d.m.Y',strtotime($ed));
        }
        
        $xml_args = array(
            'wait' => $data['wait'],
            'merchant_id' => $data['merchant_id'],
            'password' => $data['password'],
            'payment_id' => sha1(md5(rand(10, 11))),
            'card' => $data['cardnum'],
            'sd' => $sd,
            'ed' => $ed
        );

        $xml = PP_Build_XML_Helper::pp_build_statements_xml($xml_args);

        $response = PP_XML_Request::pp_make_xml_request("https://api.privatbank.ua/p24api/rest_fiz", $xml);
        $statements = new \SimpleXMLElement($response);
        $statements_list = $statements->data->info->statements;
        $statements_list_items = $statements_list->children();

        $table = $wpdb->prefix.'privat24_merchant_statement';

        $format = array(
            '%d',
            '%f',
            '%f',
            '%s',
            '%s'
        );

        $db_data = array(
            'merchant_id' => $merchant_id,
            'credit' => $statements_list['credit'],
            'debit' => $statements_list['debet'],
            'card' => $card,
            'statements' => json_encode($statements_list_items)
        );

        $db->insert_data($table, $db_data, $format);

        return PP_Response_Helper::pp_json_response(200, 'Ok', json_encode($statements_list));

    }

}