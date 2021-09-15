<?php

namespace WooUkrainianPaymentGateways\App\Helpers;

use WooUkrainianPaymentGateways\App\Helper;

if (!defined('ABSPATH')) {
    die;
}

/**
 * Helper class for making XML Request
 */
class PP_XML_Request extends Helper
{

    /**
     * Make xml request with api_url and xml file. Based on cURL
     *
     * @param string $api_uri
     * @param string $xml
     * @return xml document
     */
    public static function pp_make_xml_request($api_uri = '', $xml = '')
    {
        $result = wp_remote_post($api_uri, array(
            'headers' => array(
                "Content-Type" => "text/xml",
                "Content-length" => strlen($xml),
                "Connection" => "close",
                "Access-Control-Allow-Origin" => "*",
                'Accept" => "text/xml'
            ),
            'user-agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.8; rv:20.0) Gecko/20100101 Firefox/20.0',
            'method' => 'POST',
            'sslverify' => true,
            'timeout' => 100,
            'body' => $xml
        ));
        $response = $result;
        return $response['body'];
    }

}