<?php
/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 2/22/2019
 * Time: 3:37 PM
 */
require_once __DIR__.'/../_session.php';
require_once __DIR__.'/../controller/config.php';

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






$fn = getInput('fn');
//send email
if($fn=='fxPass'){
    $user_id = getInput('member_id');
    $language = getInput('language');

    $HOST_URL = '/api/sendConfirmEmail';
    $HOST_METHOD = 'POST';
    $HOST_DATA = [
        'user_email'=> $USER_EM,
        'login_token'=> $USER_TK,
        'id'=>$user_id,
        'language'=>$language
    ];
    $result = getUrl($HOST_URL , $HOST_DATA , $HOST_METHOD);
    echo json_encode($result);
    exit();
}
elseif($fn=='fxAccount'){
    $user_id = getInput('member_id');
    $language = getInput('language');

    $HOST_URL = '/api/sendConfirmAccount';
    $HOST_METHOD = 'POST';
    $HOST_DATA = [
        'user_email'=> $USER_EM,
        'login_token'=> $USER_TK,
        'id'=>$user_id,
        'language'=>$language
    ];
    $result = getUrl($HOST_URL , $HOST_DATA , $HOST_METHOD);
    echo json_encode($result);
    exit();
}
elseif($fn=='fxForget'){
    $user_id = getInput('member_id');
    $language = getInput('language');
    $url = getInput('url');

    $HOST_URL = '/api/sendForgetPassFx';
    $HOST_METHOD = 'POST';
    $HOST_DATA = [
        'user_email'=> $USER_EM,
        'login_token'=> $USER_TK,
        'id'=>$user_id,
        'url'=>$url,
        'language'=>$language
    ];
    $result = getUrl($HOST_URL , $HOST_DATA , $HOST_METHOD);
    echo json_encode($result);
    exit();
}
elseif($fn=='fxMt4'){
    $user_id = getInput('member_id');
    $language = getInput('language');
    $url = getInput('url');
    $login = getInput('login');

    $HOST_URL = '/api/sendForgetPassMt4';
    $HOST_METHOD = 'POST';
    $HOST_DATA = [
        'user_email'=> $USER_EM,
        'login_token'=> $USER_TK,
        'id'=>$user_id,
        'url'=>$url,
        'login'=>$login,
        'language'=>$language
    ];
    $result = getUrl($HOST_URL , $HOST_DATA , $HOST_METHOD);
    echo json_encode($result);
    exit();
}

//verify account
elseif($fn=='accountPass'){
    $user_id = getInput('member_id');
    $language = getInput('language');
    $HOST_URL = '/api/verifyFxUserConfirm';
    $HOST_METHOD = 'POST';
    $HOST_DATA = [
        'user_email'=> $USER_EM,
        'login_token'=> $USER_TK,
        'id'=>$user_id,
        'language'=> $language,
        'ip_address'=> ipAddr()
    ];
    $result = getUrl($HOST_URL , $HOST_DATA , $HOST_METHOD);
    if(isset($result['code'])){
        echo json_encode($result);
        exit();
    }else{
        echo json_encode([
            'code'=>201,
            'status_text'=> 'Connect URL ERR.',
            'result'=>[]
        ]);
        exit();
    }
}
elseif($fn=='accountReject'){

    $user_id = getInput('member_id');
    $message = getInput('message');
    $language = getInput('language');

    $HOST_URL = '/api/verifyFxUserReject';
    $HOST_METHOD = 'POST';
    $HOST_DATA = [
        'user_email'=> $USER_EM,
        'login_token'=> $USER_TK,
        'id'=>$user_id,
        'verify_account_message'=>$message,
        'language'=> $language,
        'ip_address'=> ipAddr()
    ];
    $result = getUrl($HOST_URL , $HOST_DATA , $HOST_METHOD);
    if(isset($result['code'])){
        echo json_encode($result);
        exit();
    }else{
        echo json_encode([
            'code'=>201,
            'status_text'=> 'Connect URL ERR.',
            'result'=>[]
        ]);
        exit();
    }
}

elseif($fn=='bankPass'){

    $bank_id = getInput('bank_id');
    $language = getInput('language');

    $HOST_URL = '/api/verifyBankConfirm';
    $HOST_METHOD = 'POST';
    $HOST_DATA = [
        'user_email'=> $USER_EM,
        'login_token'=> $USER_TK,
        'id'=>$bank_id,
        'language'=> $language,
        'ip_address'=> ipAddr()
    ];
    $result = getUrl($HOST_URL , $HOST_DATA , $HOST_METHOD);
    if(isset($result['code'])){
        echo json_encode($result);
        exit();
    }else{
        echo json_encode([
            'code'=>201,
            'status_text'=> 'Connect URL ERR.',
            'result'=>[]
        ]);
        exit();
    }
}
elseif($fn=='bankReject'){

    $bank_id = getInput('bank_id');
    $message = getInput('message');
    $language = getInput('language');

    $HOST_URL = '/api/verifyBankReject';
    $HOST_METHOD = 'POST';
    $HOST_DATA = [
        'user_email'=> $USER_EM,
        'login_token'=> $USER_TK,
        'id'=>$bank_id,
        'message'=>$message,
        'language'=> $language,
        'ip_address'=> ipAddr()
    ];
    $result = getUrl($HOST_URL , $HOST_DATA , $HOST_METHOD);
    if(isset($result['code'])){
        echo json_encode($result);
        exit();
    }else{
        echo json_encode([
            'code'=>201,
            'status_text'=> 'Connect URL ERR.',
            'result'=>[]
        ]);
        exit();
    }
}

//payment
elseif($fn=='transferPass'){

    $transfer_id = getInput('transfer_id');
    $language = getInput('language');

    $HOST_URL = '/api/transferBankApprove';
    $HOST_METHOD = 'POST';
    $HOST_DATA = [
        'user_email'=> $USER_EM,
        'login_token'=> $USER_TK,
        'id'=>$transfer_id,
        'language'=> $language,
        'ip_address'=> ipAddr()
    ];
    $result = getUrl($HOST_URL , $HOST_DATA , $HOST_METHOD);
    if(isset($result['code'])){
        echo json_encode($result);
        exit();
    }else{
        echo json_encode([
            'code'=>201,
            'status_text'=> 'Connect URL ERR.',
            'result'=>[]
        ]);
        exit();
    }
}
elseif($fn=='transferReject'){

    $transfer_id = getInput('transfer_id');
    $message = getInput('message');
    $language = getInput('language');

    $HOST_URL = '/api/transferBankReject';
    $HOST_METHOD = 'POST';
    $HOST_DATA = [
        'user_email'=> $USER_EM,
        'login_token'=> $USER_TK,
        'id'=>$transfer_id,
        'message'=>$message,
        'language'=> $language,
        'ip_address'=> ipAddr()
    ];
    $result = getUrl($HOST_URL , $HOST_DATA , $HOST_METHOD);
    if(isset($result['code'])){
        echo json_encode($result);
        exit();
    }else{
        echo json_encode([
            'code'=>201,
            'status_text'=> 'Connect URL ERR.',
            'result'=>[]
        ]);
        exit();
    }
}

elseif($fn=='paysecPass'){

    $cartid = getInput('cartid');
    $language = getInput('language');

    $HOST_URL = '/api/paysecApprove';
    $HOST_METHOD = 'POST';
    $HOST_DATA = [
        'user_email'=> $USER_EM,
        'login_token'=> $USER_TK,
        'cartid'=>$cartid,
        'language'=> $language,
        'ip_address'=> ipAddr()
    ];
    $result = getUrl($HOST_URL , $HOST_DATA , $HOST_METHOD);
    if(isset($result['code'])){
        echo json_encode($result);
        exit();
    }else{
        echo json_encode([
            'code'=>201,
            'status_text'=> 'Connect URL ERR.',
            'result'=>[]
        ]);
        exit();
    }
}
elseif($fn=='paysecReject'){

    $cartid = getInput('cartid');
    $message = getInput('message');
    $language = getInput('language');

    $HOST_URL = '/api/paysecReject';
    $HOST_METHOD = 'POST';
    $HOST_DATA = [
        'user_email'=> $USER_EM,
        'login_token'=> $USER_TK,
        'cartid'=>$cartid,
        'message'=>$message,
        'language'=> $language,
        'ip_address'=> ipAddr()
    ];
    $result = getUrl($HOST_URL , $HOST_DATA , $HOST_METHOD);
    if(isset($result['code'])){
        echo json_encode($result);
        exit();
    }else{
        echo json_encode([
            'code'=>201,
            'status_text'=> 'Connect URL ERR.',
            'result'=>[]
        ]);
        exit();
    }
}
elseif($fn=='paysecUpdateCheck'){

    $cartid = getInput('cartid');
    $language = getInput('language');

    $HOST_URL = '/api/paysecCheck';
    $HOST_METHOD = 'POST';
    $HOST_DATA = [
        'user_email'=> $USER_EM,
        'login_token'=> $USER_TK,
        'cartid'=>$cartid,
        'language'=> $language
    ];
    $result = getUrl($HOST_URL , $HOST_DATA , $HOST_METHOD);
    if(isset($result['code'])){
        echo json_encode($result);
        exit();
    }else{
        echo json_encode([
            'code'=>201,
            'status_text'=> 'Connect URL ERR.',
            'result'=>[]
        ]);
        exit();
    }
}

//withdrawal
elseif($fn=='withdrawalReject'){

    $transfer_id = getInput('transfer_bank_id');
    $message = getInput('message');
    $language = getInput('language');

    $HOST_URL = '/api/withdrawalBankReject';
    $HOST_METHOD = 'POST';
    $HOST_DATA = [
        'user_email'=> $USER_EM,
        'login_token'=> $USER_TK,
        'id'=>$transfer_id,
        'message'=>$message,
        'language'=> $language,
        'ip_address'=> ipAddr()
    ];
    $result = getUrl($HOST_URL , $HOST_DATA , $HOST_METHOD);
    if(isset($result['code'])){
        echo json_encode($result);
        exit();
    }else{
        echo json_encode([
            'code'=>201,
            'status_text'=> 'Connect URL ERR.',
            'result'=>[]
        ]);
        exit();
    }
}
elseif($fn=='withdrawalPass'){

    $transfer_id = getInput('transfer_id');
    $language = getInput('language');

    $HOST_URL = '/api/withdrawalBankApprove';
    $HOST_METHOD = 'POST';
    $HOST_DATA = [
        'user_email'=> $USER_EM,
        'login_token'=> $USER_TK,
        'id'=>$transfer_id,
        'language'=> $language,
        'ip_address'=> ipAddr()
    ];
    $result = getUrl($HOST_URL , $HOST_DATA , $HOST_METHOD);
    if(isset($result['code'])){
        echo json_encode($result);
        exit();
    }else{
        echo json_encode([
            'code'=>201,
            'status_text'=> 'Connect URL ERR.',
            'result'=>[]
        ]);
        exit();
    }
}

//transaction
elseif($fn=='transactionFxMt4'){

    $mt4_login = getInput('mt4_login');
    $HOST_URL = '/api/transactionFxMt4';
    $HOST_METHOD = 'GET';
    $HOST_DATA = [
        'user_email'=> $USER_EM,
        'login_token'=> $USER_TK,
        'mt4_login'=>$mt4_login
    ];
    $result = getUrl($HOST_URL , $HOST_DATA , $HOST_METHOD);
    if(isset($result['code'])){
        echo json_encode($result);
        exit();
    }else{
        echo json_encode([
            'code'=>201,
            'status_text'=> 'Connect URL ERR.',
            'result'=>[]
        ]);
        exit();
    }
}


//log
elseif($fn=='logUser'){

    $member_id = getInput('member_id');
    $HOST_URL = '/api/logUser';
    $HOST_METHOD = 'GET';
    $HOST_DATA = [
        'user_email'=> $USER_EM,
        'login_token'=> $USER_TK,
        'id'=>$member_id
    ];
    $result = getUrl($HOST_URL , $HOST_DATA , $HOST_METHOD);
    if(isset($result['code'])){
        echo json_encode($result);
        exit();
    }else{
        echo json_encode([
            'code'=>201,
            'status_text'=> 'Connect URL ERR.',
            'result'=>[]
        ]);
        exit();
    }
}
elseif($fn=='logBookBank'){

    $member_id = getInput('member_id');
    $HOST_URL = '/api/logUserBank';
    $HOST_METHOD = 'GET';
    $HOST_DATA = [
        'user_email'=> $USER_EM,
        'login_token'=> $USER_TK,
        'user_id'=>$member_id
    ];
    $result = getUrl($HOST_URL , $HOST_DATA , $HOST_METHOD);
    if(isset($result['code'])){
        echo json_encode($result);
        exit();
    }else{
        echo json_encode([
            'code'=>201,
            'status_text'=> 'Connect URL ERR.',
            'result'=>[]
        ]);
        exit();
    }
}
elseif($fn=='logTransfer'){

    $mt4_login = getInput('mt4_login');
    $HOST_URL = '/api/logMt4Trade';
    $HOST_METHOD = 'GET';
    $HOST_DATA = [
        'user_email'=> $USER_EM,
        'login_token'=> $USER_TK,
        'mt4_login'=>$mt4_login
    ];
    $result = getUrl($HOST_URL , $HOST_DATA , $HOST_METHOD);
    if(isset($result['code'])){
        echo json_encode($result);
        exit();
    }else{
        echo json_encode([
            'code'=>201,
            'status_text'=> 'Connect URL ERR.',
            'result'=>[]
        ]);
        exit();
    }
}
elseif($fn=='logPaysec'){

    $mt4_login = getInput('mt4_login');
    $HOST_URL = '/api/logPaysec';
    $HOST_METHOD = 'GET';
    $HOST_DATA = [
        'user_email'=> $USER_EM,
        'login_token'=> $USER_TK,
        'mt4_login'=>$mt4_login
    ];
    $result = getUrl($HOST_URL , $HOST_DATA , $HOST_METHOD);
    if(isset($result['code'])){
        echo json_encode($result);
        exit();
    }else{
        echo json_encode([
            'code'=>201,
            'status_text'=> 'Connect URL ERR.',
            'result'=>[]
        ]);
        exit();
    }
}
elseif($fn=='logBank'){

    $mt4_login = getInput('mt4_login');
    $HOST_URL = '/api/logTransferBank';
    $HOST_METHOD = 'GET';
    $HOST_DATA = [
        'user_email'=> $USER_EM,
        'login_token'=> $USER_TK,
        'mt4_login'=>$mt4_login
    ];
    $result = getUrl($HOST_URL , $HOST_DATA , $HOST_METHOD);
    if(isset($result['code'])){
        echo json_encode($result);
        exit();
    }else{
        echo json_encode([
            'code'=>201,
            'status_text'=> 'Connect URL ERR.',
            'result'=>[]
        ]);
        exit();
    }
}


//management
elseif($fn=='manageStatus'){
    $password = getInput('password');
    $member_email = getInput('member_email');
    $mt4_login = getInput('mt4_login');
    $status = getInput('status');

    $HOST_URL = '/api/manageAccountStatus';
    $HOST_METHOD = 'POST';
    $HOST_DATA = [
        'user_email'=> $USER_EM,
        'login_token'=> $USER_TK,
        'password'=> $password,
        'member_email' => $member_email,
        'mt4_login' => $mt4_login,
        'status'=> $status,
        'ip_address'=> ipAddr()
    ];
    $result = getUrl($HOST_URL , $HOST_DATA , $HOST_METHOD);
    if(isset($result['code'])){
        echo json_encode($result);
        exit();
    }else{
        echo json_encode([
            'code'=>201,
            'status_text'=> 'Connect URL ERR.',
            'result'=>[]
        ]);
        exit();
    }
}
elseif($fn=='manageDeposit'){
    $password = getInput('password');
    $member_email = getInput('member_email');
    $mt4_login = getInput('mt4_login');
    $status = getInput('status');
    $amount = getInput('amount');

    $HOST_URL = '/api/manageDeposit';
    $HOST_METHOD = 'POST';
    $HOST_DATA = [
        'user_email'=> $USER_EM,
        'login_token'=> $USER_TK,
        'password'=> $password,
        'member_email' => $member_email,
        'mt4_login' => $mt4_login,
        'amount' => $amount,
        'type'=> $status,
        'ip_address'=> ipAddr()
    ];
    $result = getUrl($HOST_URL , $HOST_DATA , $HOST_METHOD);
    if(isset($result['code'])){
        echo json_encode($result);
        exit();
    }else{
        echo json_encode([
            'code'=>201,
            'status_text'=> 'Connect URL ERR.',
            'result'=>[]
        ]);
        exit();
    }
}
elseif($fn=='manageWithdraw'){
    $password = getInput('password');
    $member_email = getInput('member_email');
    $mt4_login = getInput('mt4_login');
    $status = getInput('status');
    $amount = getInput('amount');

    $HOST_URL = '/api/manageWithdrawal';
    $HOST_METHOD = 'POST';
    $HOST_DATA = [
        'user_email'=> $USER_EM,
        'login_token'=> $USER_TK,
        'password'=> $password,
        'member_email' => $member_email,
        'mt4_login' => $mt4_login,
        'amount' => $amount,
        'type'=> $status,
        'ip_address'=> ipAddr()
    ];
    $result = getUrl($HOST_URL , $HOST_DATA , $HOST_METHOD);
    if(isset($result['code'])){
        echo json_encode($result);
        exit();
    }else{
        echo json_encode([
            'code'=>201,
            'status_text'=> 'Connect URL ERR.',
            'result'=>[]
        ]);
        exit();
    }
}
elseif($fn=='managePass'){
    $password = getInput('password');
    $member_email = getInput('member_email');
    $mt4_login = getInput('mt4_login');
    $new_pass = getInput('new_password');
    $type = getInput('type','investor');

    $HOST_URL = '/api/manageSetPasswordMt4';
    $HOST_METHOD = 'POST';
    $HOST_DATA = [
        'user_email'=> $USER_EM,
        'login_token'=> $USER_TK,
        'password'=> $password,
        'member_email' => $member_email,
        'mt4_login' => $mt4_login,
        'new_password'=> $new_pass,
        'type'=> $type,
        'ip_address'=> ipAddr()
    ];
    $result = getUrl($HOST_URL , $HOST_DATA , $HOST_METHOD);
    if(isset($result['code'])){
        echo json_encode($result);
        exit();
    }else{
        echo json_encode([
            'code'=>201,
            'status_text'=> 'Connect URL ERR.',
            'result'=>[]
        ]);
        exit();
    }
}




