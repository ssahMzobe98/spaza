<?php

namespace Classes\payment_integration;

use Controller\mmshightech;
use Controller\mmshightech\usersPdo;
use Classes\response\Response;
class paymentPdo{
    private mmshightech $mmshightech;
    private usersPdo $usersPdo;
    private $Response;
    public function __construct(mmshightech $mmshightech){
        $this->mmshightech=$mmshightech;
        $this->usersPdo = new usersPdo($mmshightech);
        $this->Response = new Response();
    }
    public function paymentGateway(?int $clientId=0,?float $amount=0.00,?int $order_number_toPay):Response{
        $user_details = $this->usersPdo->getUserDetailsForUser($clientId);
        $passPhrase = 'msiziMzobe98';
        $amount_net=$amount-4.60;
        $data = array(
            'merchant_id' => 18152361,
            'merchant_key' => '2ammma77nrah4',
            'return_url' => 'https://netchatsa.com/?apply',
            'cancel_url' => 'https://netchatsa.com/cancel.php',
            'notify_url' => 'https://netchatsa.com/notify.php',
            'name_first'=>$user_details['name'],
            'name_last'=>$user_details['surname'],
            'email_address'=>$user_details['usermail'],
            'm_payment_id' => $order_number_toPay,
            'amount' => number_format( sprintf( '%.2f', $amount ), 2, '.', '' ),
            'item_name' => 'ISPAZA PRODUCTS PURCHASE'

        );
            // Generate signature (see Custom Integration -> Step 2)
        $data["signature"] = $this->generateSignature($data, $passPhrase);
        $pfParamString = $this->dataToString($data);
        //echo 'Param : '.$pfParamString;

        $identifier = $this->generatePaymentIdentifier($pfParamString);
        $data['pf_payment_id'] = '';
        $data['item_description'] = 'THIS PAYMENT IS MADE ONLY FOR TERTIARY APPLICATION. IT IS NOT AN APPLICATION FEE. IT IS AN ADMINISTRATION FEE.';
        $data['amount_gross'] = number_format( sprintf( '%.2f', $amount ), 2, '.', '' );
        $data['amount_fee'] = 2.48;
        $data['amount_net'] = $amount_net;
        $data['payment_status'] = 'PAID';
        $data['identifier']=$identifier;
        $data['pfParamString']=$pfParamString;


        if($identifier!==null){
            $this->Response->responseStatus="S";
            $this->Response->responseStatus="Payment in Progress.";
            $this->Response->data=$data;
            return $this->Response;
        }
        $this->Response->responseStatus="F";
        $this->Response->responseStatus="Failed to generate Payment Identifier - {$identifier}";
        return $this->Response;
    }
    public function generateSignature($data, $passPhrase = null):string {
        // Create parameter string
        $pfOutput = '';
        foreach( $data as $key => $val ) {
            if(!empty($val)) {
                $pfOutput .= $key .'='. urlencode( trim( $val ) ) .'&';
            }
        }
        // Remove last ampersand
        $getString = substr( $pfOutput, 0, -1 );
        if( $passPhrase !== null ) {
            $getString .= '&passphrase='. urlencode( trim( $passPhrase ) );
        }
        return md5($getString);
    }
    public function dataToString($dataArray) :string{
        // Create parameter string
        $pfOutput = '';
        foreach( $dataArray as $key => $val ) {
            if($val !== '') {
                $pfOutput .= $key .'='. urlencode( trim( $val ) ) .'&';
            }
        }
        // Remove last ampersand
        return substr( $pfOutput, 0, -1 );
    }
    public function generatePaymentIdentifier($pfParamString, $pfProxy = null) :float|string|int|null{
        // Use cURL (if available)
        if( in_array( 'curl', get_loaded_extensions(), true ) ) {
            // Variable initialization
            $url = 'https://www.payfast.co.za/onsite/process';

            // Create default cURL object
            $ch = curl_init();

            // Set cURL options - Use curl_setopt for greater PHP compatibility
            // Base settings
            curl_setopt( $ch, CURLOPT_USERAGENT, NULL );  // Set user agent
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );      // Return output as string rather than outputting it
            curl_setopt( $ch, CURLOPT_HEADER, false );             // Don't include header in output
            curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 2 );
            curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, true );

            // Standard settings
            curl_setopt( $ch, CURLOPT_URL, $url );
            curl_setopt( $ch, CURLOPT_POST, true );
            curl_setopt( $ch, CURLOPT_POSTFIELDS, $pfParamString );
            if( !empty( $pfProxy ) )
                curl_setopt( $ch, CURLOPT_PROXY, $pfProxy );

            // Execute cURL
            $response = curl_exec( $ch );
            curl_close($ch );
            // echo $response;
            $rsp = json_decode($response, true);
            if ($rsp['uuid']) {
                return $rsp['uuid'];
            }
        }
        return null;
    }
    public function pfValidIP() :bool{
        // Variable initialization
        $validHosts = array(
            'www.payfast.co.za',
            'sandbox.payfast.co.za',
            'w1w.payfast.co.za',
            'w2w.payfast.co.za',
        );

        $validIps = [];

        foreach( $validHosts as $pfHostname ) {
            $ips = gethostbynamel( $pfHostname );

            if( $ips !== false )
                $validIps = array_merge( $validIps, $ips );
        }

        // Remove duplicates
        $validIps = array_unique( $validIps );
        $referrerIp = gethostbyname(parse_url($_SERVER['HTTP_REFERER'])['host']);
        if( in_array( $referrerIp, $validIps, true ) ) {
            return true;
        }
        return false;
    }
    public function pfValidPaymentData( $cartTotal, $amount_gross ) :bool|string|int{
        return !(abs((float)$cartTotal - (float)$amount_gross) > 0.01);
    }
    public function pfValidSignature( $pfDataSignature, $pfParamString, $pfPassphrase = null ):bool {
        // Calculate security signature
        if($pfPassphrase === null) {
            $tempParamString = $pfParamString;
        } else {
            $tempParamString = $pfParamString.'&passphrase='.urlencode( $pfPassphrase );
        }

        $signature = md5( $tempParamString );
        return ( $pfDataSignature === $signature );
    }
    public function pfValidServerConfirmation( $pfParamString, $pfHost = 'sandbox.payfast.co.za', $pfProxy = null ):bool {
        // Use cURL (if available)
        if( in_array( 'curl', get_loaded_extensions(), true ) ) {
            // Variable initialization
            $url = 'https://'. $pfHost .'/eng/query/validate';

            // Create default cURL object
            $ch = curl_init();

            // Set cURL options - Use curl_setopt for greater PHP compatibility
            // Base settings
            curl_setopt( $ch, CURLOPT_USERAGENT, NULL );  // Set user agent
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );      // Return output as string rather than outputting it
            curl_setopt( $ch, CURLOPT_HEADER, false );             // Don't include header in output
            curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 2 );
            curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, true );

            // Standard settings
            curl_setopt( $ch, CURLOPT_URL, $url );
            curl_setopt( $ch, CURLOPT_POST, true );
            curl_setopt( $ch, CURLOPT_POSTFIELDS, $pfParamString );
            if( !empty( $pfProxy ) )
                curl_setopt( $ch, CURLOPT_PROXY, $pfProxy );

            // Execute cURL
            $response = curl_exec( $ch );
            curl_close( $ch );
            if ($response === 'VALID') {
                return true;
            }
        }
        return false;
    }
    public function object_to_array($data):array|string|int
    {
        if (is_array($data) || is_object($data))
        {
            $result = [];
            foreach ($data as $key => $value)
            {
                $result[$key] = (is_array($value) || is_object($value)) ? object_to_array($value) : $value;
            }
            return $result;
        }
        return $data;
    }
    public function processPayment(?int $client_id,$m_payment_id,$pf_payment_id,$payment_status,$item_name,$item_description,$amount_gross,$amount_fee, $amount_net, $name_first,$name_last, $email_address, $merchant_id):array{
        return ['response'=>"S","data"=>"Success"];
    }

}

?>