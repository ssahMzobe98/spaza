<?php
include("../vendor/autoload.php");
// include("./mmshightech.php");
use Controller\mmshightech;
$mmshightech = new mmshightech();
$errorMessage = "UNKNOWN REQUEST!!";
// Function to encrypt data using AES-128-CTR
function encryptData($data) {
    $ciphering = "AES-128-CTR";
    $iv_length = openssl_cipher_iv_length($ciphering);
    $options = 0;
    $encryption_iv = '0685153023980510';
    $encryption_key = "MaLwandeMkhize";
    $encryption = openssl_encrypt($data, $ciphering, $encryption_key, $options, $encryption_iv);
    return $encryption;
}

// Check if login credentials are provided
if (isset($_POST['email'], $_POST['pass'])) {
    $email = $mmshightech->OMO($_POST['email']);
    $pass = $mmshightech->OMO($_POST['pass']);

    // Check password length
    if (strlen($pass) < 7) {
        $errorMessage = "Password too short!!";
    } else {
        $response = $mmshightech->login($email, $pass);

        if ($response['response'] == "S") {
            session_start();
            $_SESSION['user_agent'] = $email;
            $_SESSION['var_agent'] = $mmshightech->lockPassWord($email . $mmshightech->lockPassWord($pass));

            // Create a simple string for encryption
            $simpleString = $_POST['email'] . "-" . $_POST['pass'];

            // Encrypt the simple string
            $encryption = encryptData($simpleString);

            // Cookie options
            $arrCookieOptions = array(
                'expires' => time() + 60 * 60 * 24 * 30,
                'path' => '/',
                'domain' => '.netchatsa.com',
                'secure' => true,
                'httponly' => true,
                'samesite' => 'None'
            );

            // Set cookies
            setcookie("umfazi", $mmshightech->lockPassWord($mmshightech->lockPassWord($_POST['email']) . $mmshightech->lockPassWord($_POST['pass'])), $arrCookieOptions['expires'], $arrCookieOptions['path'], $arrCookieOptions['domain'], true, true);
            setcookie("indoda", $mmshightech->lockPassWord($mmshightech->lockPassWord("nnjvgftgdb sdf@jhbds") . $mmshightech->lockPassWord(md5("jkndfsd @nkdndsfsdf"))), $arrCookieOptions['expires'], $arrCookieOptions['path'], $arrCookieOptions['domain'], true, true);
            setcookie("hlomula", $mmshightech->lockPassWord($mmshightech->lockPassWord(md5("123456fgdfgdf")) . $mmshightech->lockPassWord(md5("123fd123"))), $arrCookieOptions['expires'], $arrCookieOptions['path'], $arrCookieOptions['domain'], true, true);
            setcookie("ibhubesi", $encryption, $arrCookieOptions['expires'], $arrCookieOptions['path'], $arrCookieOptions['domain'], true, true);
            $errorMessage = 1;
        } else {
            $errorMessage = $response['data'];
        }
    }
}
// Check if credentials for App login are provided
elseif (isset($_POST['emailApp'], $_POST['passApp'], $_POST['app'])) {
    $email = $mmshightech->OMO($_POST['emailApp']);
    $pass = $mmshightech->OMO($_POST['passApp']);
    $app = $mmshightech->OMO($_POST['app']);

    // Check password length
    if (strlen($pass) < 7) {
        $errorMessage = "Password too short!!";
    } else {
        $response = $mmshightech->login2App($email, $pass, $app);

        if ($response['response'] == "S") {
            session_start();
            $_SESSION['user_agent'] = $email;
            $_SESSION['var_agent'] = $mmshightech->lockPassWord($email . $mmshightech->lockPassWord($pass));

            // Create a simple string for encryption
            $simpleString = $email . "-" . $pass . "-" . $app;

            // Encrypt the simple string
            $encryption = encryptData($simpleString);

            // Cookie options
            $arrCookieOptions = array(
                'expires' => time() + 60 * 60 * 24 * 30,
                'path' => '/',
                'domain' => '.netchatsa.com',
                'secure' => true,
                'httponly' => true,
                'samesite' => 'None'
            );

            // Set cookies
            setcookie("umfazi", $mmshightech->lockPassWord($mmshightech->lockPassWord($email) . $mmshightech->lockPassWord($pass)), $arrCookieOptions['expires'], $arrCookieOptions['path'], $arrCookieOptions['domain'], true, true);
            setcookie("indoda", $mmshightech->lockPassWord($mmshightech->lockPassWord("nnjvgftgdb sdf@jhbds") . $mmshightech->lockPassWord(md5("jkndfsd @nkdndsfsdf"))), $arrCookieOptions['expires'], $arrCookieOptions['path'], $arrCookieOptions['domain'], true, true);
            setcookie("hlomula", $mmshightech->lockPassWord($mmshightech->lockPassWord(md5("123456fgdfgdf")) . $mmshightech->lockPassWord(md5("123fd123"))), $arrCookieOptions['expires'], $arrCookieOptions['path'], $arrCookieOptions['domain'], true, true);
            setcookie("ibhubesi", $encryption, $arrCookieOptions['expires'], $arrCookieOptions['path'], $arrCookieOptions['domain'], true, true);
            $errorMessage = 1;
        } else {
            $errorMessage = $response['data'];
        }
    }
}

// Return the result as JSON
echo json_encode($errorMessage);
?>
