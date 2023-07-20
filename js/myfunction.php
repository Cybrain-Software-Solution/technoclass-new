<?php 

session_start();
 include "config_new.php";

if (!function_exists('cleanInput')) {
    function cleanInput($input)
    {
     return strip_tags(addslashes($input));
    }
}

function mysql_escape_mimic($inp) {
    if(is_array($inp))
        return array_map(__METHOD__, $inp);

    if(!empty($inp) && is_string($inp)) {
        return str_replace(array('\\', "\0", "\n", "\r", "'", '"', "\x1a"), array('\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z'), $inp);
    }

    return $inp;
}

if( !function_exists( 'csrf_formtoken' )) {
	function csrf_formtoken($form_type) {
        $length = 32;
        if(!isset($_SESSION['csrf_formtoken_'.$form_type])){
            $_SESSION['csrf_formtoken_'.$form_type] = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $length);
        }   
        $token =  $_SESSION['csrf_formtoken_'.$form_type];
		return '<input type="hidden" class="csrf_formtoken" name="csrf_formtoken" value="'.$token.'"/>';
	}
}





if(!function_exists( 'generateToken' )){
    function generateToken( $formName ){
        $secretKey = 'gsfhs154aergz2#';
        if ( !session_id() ) {
            session_start();
        }
        $sessionId = session_id();
        return sha1( $formName.$sessionId.$secretKey );

    }
}



?>