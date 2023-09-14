<?php
$e="UKNOWN REQUEST!!";
include_once("./mmshightech.php");
$mmshightech=new mmshightech();
if(isset($_POST['email'],$_POST['pass'])){
    
    $email = $mmshightech->OMO($_POST['email']);
    $pass = $mmshightech->OMO($_POST['pass']);
    if(strlen($pass)<7){
        $e = "Password too short!!";
    }
    else{
        $response = $mmshightech->login($email,$pass);
        if($response['response']=="S"){
            session_start();
            $_SESSION['user_agent'] = $email;
            $_SESSION['var_agent'] = $mmshightech->lockPassWord($email.$mmshightech->lockPassWord($pass));
            $simple_string =$_POST['email']."-".$_POST['pass'];
            $ciphering = "AES-128-CTR"; 
            $iv_length = openssl_cipher_iv_length($ciphering); 
            $options = 0; 
            $encryption_iv = '0685153023980510'; 
            $encryption_key = "MaLwandeMkhize"; 
            $encryption = openssl_encrypt($simple_string, $ciphering, $encryption_key, $options, $encryption_iv);
            $arr_cookie_options = array (
                'expires' => time() + 60*60*24*30,
                'path' => '/',
                'domain' => '.netchatsa.com',
                'secure' => true,
                'httponly' => true,
                'samesite' => 'None'
            );
            setcookie("umfazi", $mmshightech->lockPassWord($mmshightech->lockPassWord($_POST['email']).$mmshightech->lockPassWord($_POST['pass'])), $arr_cookie_options['expires'],$arr_cookie_options['path'],$arr_cookie_options['domain'],true,true);
            
            setcookie("indoda",$mmshightech->lockPassWord($mmshightech->lockPassWord("nnjvgftgdb sdf@jhbds").$mmshightech->lockPassWord(md5("jkndfsd @nkdndsfsdf"))), $arr_cookie_options['expires'],$arr_cookie_options['path'],$arr_cookie_options['domain'],true,true);
            setcookie("hlomula",$mmshightech->lockPassWord($mmshightech->lockPassWord(md5("123456fgdfgdf")).$mmshightech->lockPassWord(md5("123fd123"))), $arr_cookie_options['expires'],$arr_cookie_options['path'],$arr_cookie_options['domain'],true,true);
            setcookie("ibhubesi","$encryption", $arr_cookie_options['expires'],$arr_cookie_options['path'],$arr_cookie_options['domain'],true,true);
            $e=1;
            
        }
        else{
            $e=$response['data'];
        }

    }
}
elseif(isset($_POST['emailApp'],$_POST['passApp'],$_POST['app'])) {

    $email = $mmshightech->OMO($_POST['emailApp']);
    $pass = $mmshightech->OMO($_POST['passApp']);
    $app = $mmshightech->OMO($_POST['app']);
    if (strlen($pass) < 7) {
        $e = "Password too short!!";
    } else {
        $response = $mmshightech->login2App($email, $pass,$app);
        if ($response['response'] == "S") {
            session_start();
            $_SESSION['user_agent'] = $email;
            $_SESSION['var_agent'] = $mmshightech->lockPassWord($email . $mmshightech->lockPassWord($pass));
            $simple_string = $email . "-" . $pass . "-".$app;
            $ciphering = "AES-128-CTR";
            $iv_length = openssl_cipher_iv_length($ciphering);
            $options = 0;
            $encryption_iv = '0685153023980510';
            $encryption_key = "MaLwandeMkhize";
            $encryption = openssl_encrypt($simple_string, $ciphering, $encryption_key, $options, $encryption_iv);
            $arr_cookie_options = array(
                'expires' => time() + 60 * 60 * 24 * 30,
                'path' => '/',
                'domain' => '.netchatsa.com',
                'secure' => true,
                'httponly' => true,
                'samesite' => 'None'
            );
            setcookie("umfazi", $mmshightech->lockPassWord($mmshightech->lockPassWord($email) . $mmshightech->lockPassWord($pass)), $arr_cookie_options['expires'], $arr_cookie_options['path'], $arr_cookie_options['domain'], true, true);

            setcookie("indoda", $mmshightech->lockPassWord($mmshightech->lockPassWord("nnjvgftgdb sdf@jhbds") . $mmshightech->lockPassWord(md5("jkndfsd @nkdndsfsdf"))), $arr_cookie_options['expires'], $arr_cookie_options['path'], $arr_cookie_options['domain'], true, true);
            setcookie("hlomula", $mmshightech->lockPassWord($mmshightech->lockPassWord(md5("123456fgdfgdf")) . $mmshightech->lockPassWord(md5("123fd123"))), $arr_cookie_options['expires'], $arr_cookie_options['path'], $arr_cookie_options['domain'], true, true);
            setcookie("ibhubesi", "$encryption", $arr_cookie_options['expires'], $arr_cookie_options['path'], $arr_cookie_options['domain'], true, true);
            $e = 1;

        } else {
            $e = $response['data'];
        }

    }
}
echo json_encode($e);
