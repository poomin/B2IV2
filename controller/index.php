<?php
/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 2/12/2019
 * Time: 11:36 AM
 */
session_start();

require_once __DIR__.'/config.php';

function ipAddr(){
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        //ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        //ip pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}


$user_email = getInput('user_email');
$password = getInput('password');
if($user_email!='' && $password!=''){
    $url = '/api/loginFxAdmin';
    $method = 'POST';
    $rawInput = [
        'user_email'=> $user_email,
        'user_pass'=> $password,
        'ip_address'=> ipAddr()
    ];
    $result = getUrl($url,$rawInput,$method);
    if($result['code']==200){
        $_SESSION['SESSION_FX_I']= $result['result']['id'];
        $_SESSION['SESSION_FX_F']= $result['result']['full_name'];
        $_SESSION['SESSION_FX_E']= $result['result']['user_email'];
        $_SESSION['SESSION_FX_T']= $result['result']['login_token'];
        header( "Location: /profile.php" );
    }else{
        $_SESSION['SESSION_STATUS']='warning';
        $_SESSION['SESSION_TEXT']=$result['status_text'];
    }

}
elseif( !isset($_SESSION['SESSION_STATUS']) && !isset($_SESSION['SESSION_TEXT'])){
    session_destroy();
}