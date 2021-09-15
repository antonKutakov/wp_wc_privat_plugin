<?php

namespace WooUkrainianPaymentGateways\App\Helpers;

use WooUkrainianPaymentGateways\App\Helper;

if(!defined('ABSPATH')){
    die;
}

/**
 * Helper class for making XML Request
 */
class PP_XML_Request extends Helper {

    /**
     * Make xml request with api_url and xml file. Based on cURL
     *
     * @param string $api_uri
     * @param string $xml
     * @return xml document
     */
    public static function pp_make_xml_request($api_uri = '', $xml = ''){
        $result = wp_remote_post($api_uri, array(
            'headers' => array(
                "Content-Type: text/xml",
                "Content-length: ".strlen($xml),
                "Connection: close",
                "Access-Control-Allow-Origin: *",
                'Accept: text/xml'
            ),
            'method' => 'POST',
            'sslverify' => true,
            'timeout' => 100,
            'httpversion' => '1.0',
            'body' => json_encode($xml)
        ));
        $response = $result;
        return $response['body'];

    }

}