<?php

namespace WooUkrainianPaymentGateways\App\Helpers;

use WooUkrainianPaymentGateways\App\Helper;

if(!defined('ABSPATH')){
    die;
}

/**
 * Helper class for making XML
 */
class PP_Build_XML_Helper extends Helper{

    /**
     * Build xml doc for xml request
     *
     * @param array $args
     * @return string
     */
    public static function pp_build_statements_xml($args = array()){
        
        $data = '<oper>cmt</oper><wait>'.$args['wait'].'</wait><test>0</test><payment id="'.$args['payment_id'].'"><prop name="sd" value="'.$args['sd'].'" /><prop name="ed" value="'.$args['ed'].'" /><prop name="card" value="'.$args['card'].'" /></payment>';      
        $merchant_id = $args['merchant_id'];
        $password = $args['password'];
        $signature = sha1(md5($data.$password));
        
$xml = <<<XMLDOC
<?xml version="1.0" encoding="UTF-8"?>
<request version="1.0">
<merchant>
    <id>$merchant_id</id>
    <signature>$signature</signature>
</merchant>
    <data>$data</data>
</request>
XMLDOC;

    return $xml;

    }

    public static function pp_build_balance_xml($args = array()){
        $data = '<oper>cmt</oper><wait>'.$args['wait'].'</wait><test>0</test><payment id="'.$args['payment_id'].'"><prop name="cardnum" value="'.$args['card'].'"/><prop name="country" value="'.$args['country'].'"/></payment>';
        $merchant_id = $args['merchant_id'];
        $password = $args['password'];
        $signature = sha1(md5($data.$password));

$xml = <<<XMLDOC
<?xml version="1.0" encoding="UTF-8"?>
<request version="1.0">
<merchant>
<id>$merchant_id</id>
<signature>$signature</signature>
</merchant>
<data>$data</data></request>
XMLDOC;

    return $xml;

    }

}