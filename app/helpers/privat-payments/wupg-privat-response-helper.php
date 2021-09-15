<?php

namespace WooUkrainianPaymentGateways\App\Helpers;
use WooUkrainianPaymentGateways\App\Helper;

if(!defined('ABSPATH')){
    die;
}

/**
 * Helper class for making json response
 */
class PP_Response_Helper extends Helper{

    /**
     * Make json response
     *
     * @param integer $code
     * @param string $message
     * @param [mixed] $data
     * @return json
     */
    public static function pp_json_response($code = 0, $message = "", $data = null){

        $response = array(
            'code' => $code,
            'message' => $message
        );

        if(!empty($response)){
            $response['data'] = $data;
        }
        
        return json_encode($response);
        
    }

}