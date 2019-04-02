<?php
/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 4/2/2019
 * Time: 3:50 PM
 */
require_once __DIR__.'/../model/UserModel.php';
$MUser = new UserModel();

$fn = $MUser->getInput('fn');

if($fn=='login'){
    $username = $MUser->getInput('username');
    $password = $MUser->getInput('password');

    $condition = [
        'username'=>$username,
        'password'=> md5($password)
    ];

    $result = $MUser->selectThis($condition);
    if($result){
        $_SESSION['USER_ID'] = $result['id'];
        $_SESSION['USER_USERNAME']= $result['username'];
        $_SESSION['USER_ROLE']= $result['role'];
        $_SESSION['USER_IMAGE'] = $result['image_path'];
        header( "location: /lprofile.php" );
        exit(0);
    }else{
        $_SESSION['action_status']='error';
        $_SESSION['action_message']='Login fail  !!!! <br> Check your Username or password.....';
    }

}