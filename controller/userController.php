<?php
/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 4/4/2019
 * Time: 3:04 PM
 */

require_once __DIR__ . '/../model/UserModel.php';
$MUser = new UserModel();

$USERS = [];


//>>>>>>>>>>>>>> function
$fn = $MUser->getInput('fn');
if($fn=='modalDelete'){

    $user_id = $MUser->getInput('delete_id',0);

    $condition = [
        'id'=>$user_id
    ];


    $user_row = $MUser->deleteThis($condition);
    if($user_row >0){
        $_SESSION['action_status']='success';
        $_SESSION['action_message']='Delete user success.';

    }
    else{
        $_SESSION['action_status']='warning';
        $_SESSION['action_message']='Delete user fail!!!';
    }

}
elseif ($fn=='loginAdmin'){
    $user_id = $MUser->getInput('user_id');
    $condition = [
        'id'=>$user_id,
    ];

    $result = $MUser->selectThis($condition);
    if($result){
        $_SESSION['USER_ID'] = $result['id'];
        $_SESSION['USER_USERNAME']= $result['username'];
        $_SESSION['USER_ROLE']= $result['role'];
        $_SESSION['USER_IMAGE'] = $result['image_path'];
        header( "location: /lprofile.php" );
        exit(0);
    }
}


//>>>>>>>>>>>>>>> in page

//school
$sql = " WHERE role!='admin' AND userremove='n';";
$result = $MUser->selectSqlAll($sql);
if(count($result)>0){
    $USERS = $result;
}

