<?php
require_once("../../vendor/autoload.php");
use Controller\mmshightech;
use Classes\payment_integration\paymentPdo;
use Controller\mmshightech\usersPdo;
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
if (isset($_SESSION['user_agent'], $_SESSION['var_agent'])) {
    //require_once("../controller/mmshightech.php");
    $mmshightech = new mmshightech();
    $paymentPdo = new paymentPdo($mmshightech);
    $usersPdo = new usersPdo($mmshightech);
    $cur_user_row = $mmshightech->userInfo($_SESSION['user_agent']);
    $userDirect = $cur_user_row['user_type'];
    $e="YOU DO NOT HAVE PERMISSIONS TO BE HERE!!..";
    if(isset($_POST['client_id'],$_POST['amountToPay'],$_POST['pfData'],$_POST['pfParamString'])){

        $id=$_POST['client_id'];
        $client_info=$usersPdo->getUserDetailsForUser($id);
        header( 'HTTP/1.0 200 OK' );
        flush();
        // require_once("controller/pdo.php");
        define( 'SANDBOX_MODE', true );
        $pfHost = SANDBOX_MODE ? 'sandbox.payfast.co.za' : 'www.payfast.co.za';

        $pfData = $paymentPdo->object_to_array(json_decode($_POST['pfData'],true));
        // echo"<pre>";
        // print_r($pfData);
        // echo"</pre>";
        // Strip any slashes in data
        foreach( $pfData as $key => $val ) {
            $pfData[$key] = stripslashes( $val );
        }
        $pfParamString=$_POST['pfParamString'];
        // Convert posted variables to a string

        // foreach( $pfData as $key => $val ) {
        //     if( !in_array($key, ['signature','pf_payment_id','item_description','amount_gross','amount_fee','amount_net','payment_status'])) {
        //         $pfParamString .= $key .'='. urlencode( $val ) .'&';
        //     } else {
        //         break;
        //     }
        // }
        // $myFile= fopen("notify.txt","wb")or die;
        // $pfParamString = substr( $pfParamString, 0, -1 );
        // echo "<br>pfParamString : ".$pfParamString;
        // $check1 = $continueLevelAppPDO->pfValidSignature($pfData['signature'], $pfParamString);
        // $check1 ? fwrite($myFile,"pfData: ".$pfData."\n\nPFPARAM : ".$pfParamString."\n\n is valid signiture"):fwrite($myFile,$pfData."\n\n".$pfParamString."\n\n is NOT valid signiture");
        // $check2 = $continueLevelAppPDO->pfValidIP();
        $amountToPay = $pfData['amount'];
//         $check3 = $continueLevelAppPDO->pfValidPaymentData($amountToPay,$pfData['amount_gross']);
//         $check4 = $continueLevelAppPDO->pfValidServerConfirmation($pfParamString, $pfHost);
//         echo $check3?"true":"false";
//         echo $check4?"true":"false";
//         echo"<pre>";
//         print_r($pfData);
//         echo"</pre>";
//         $amountToPay=$continueLevelAppPDO->getAmountToPay($continueLevelAppPDO->getApplicationId($id));
        // $proof_of_payment=$_GET['pt'];
        $m_payment_id=$pfData['m_payment_id'];
        $pf_payment_id=$pfData['pf_payment_id'];
        $payment_status=$pfData['payment_status'];
        $item_name=$pfData['item_name'];
        $item_description=$pfData['item_description'];
        $amount_gross=$pfData['amount_gross'];
        $amount_fee=$pfData['amount_fee'];
        $amount_net=$pfData['amount_net'];
        $name_first=$pfData['name_first'];
        $name_last=$pfData['name_last'];
        $email_address=$pfData['email_address'];
        $merchant_id=$pfData['merchant_id'];
        $response=$paymentPdo->processPayment($_POST['client_id'],$m_payment_id,$pf_payment_id,$payment_status,$item_name,$item_description,$amount_gross,$amount_fee, $amount_net, $name_first,$name_last, $email_address, $merchant_id);
        if($response['response']=="F"){
            $e=$response['data'];
        }
        else{
            $emailTo=$client_info['usermail'];
            $emailFrom="np-reply@ispaza.com";
            $Message="<p>{$client_info['name']}</p><h5 style='color:green;'>PAYMENT OF (".$amountToPay.") SUCCESSFUL</h5><p>Your order has been placed successfully with complete payment👏😇.</p><h5 style='color:green;'>BURSARIES & NSFAS</h5><p>By completing your Application TAMA Organizationsa you give TAMA Organizationsa the authority to start and complete applications with NSFAS and other relevant Bursary applications depending on the choice of Career/Course </p><h5 style='color:green;'>TERTIARY INSTITUTIONS</h5><p>With TAMA Organizationsa, You will place one application with all the tertiary institutions you desire. TAMA ORGANIZATIONSA will forward your application to all selected (by applicant choice) Tertiry Institutions.</p>";
            $subject="Payment Success";
            //$mmshightech->sendEmail($emailTo,$emailFrom,$Message,$subject);
            $Message="<p>Mr MS Mzobe </p><h5 style='color:green;'>PAYMENT OF (".$amountToPay.") SUCCESSFUL By user ({$emailTo} - {$id})</h5><p></p>";
            $subject="Payment success from customer-{$_POST['client_id']}";
            //$mmshightech->sendEmail("netchatsa@gmail.com",$emailFrom,$Message,$subject);
            $e=1;
        }
    }
    echo json_encode($e);
}
else{
    session_destroy();
    ?>
    <script>
        window.location=("../");
    </script>

    <?php
}
