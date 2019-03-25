<?php
/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 2/12/2019
 * Time: 10:07 AM
 */

//$CONFIG_HOST = 'localhost:55001';
$CONFIG_HOST = 'quantimentum.com:55002';

function getUrl($url,$data,$method){
    global $CONFIG_HOST;
    $url = $CONFIG_HOST.''.$url;

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL =>$url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => $method,
        CURLOPT_POSTFIELDS => json_encode($data),
        CURLOPT_HTTPHEADER => array(
            "Content-Type: application/json",
        ),
    ));
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    if ($err) {
        return [
            'code'=>400,
            'status_text'=>'cURL Error',
            'result'=>$err
        ];
    } else {
        $result = json_decode($response, true);
        if($result==null){
            return [
                'code'=>400,
                'status_text'=>'cURL Error',
                'result'=>$err
            ];
        }else{
            return $result;
        }

    }
}

function getInput($parameter,$default=''){
    return isset($_REQUEST[$parameter])?$_REQUEST[$parameter]:$default;
}

function setInput($dataInput,$default=''){
    return isset($dataInput)?$dataInput:$default;
}