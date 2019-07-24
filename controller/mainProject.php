<?php
/**
 * Created by PhpStorm.
 * User: PF0T4E5G
 * Date: 16/4/2562
 * Time: 01:01 ก่อนเที่ยง
 */
require_once __DIR__.'/../model/MainProjectModel.php';

$MMain = new MainProjectModel();

$MAINS = [];


$fn = $MMain->getInput('fn');
if($fn=='insertMainProject'){
    $p_year = $MMain->getInput('year');
    $p_name = $MMain->getInput('name');
    $p_name_en = $MMain->getInput('name_en');

    $raw = [
        'main_year'=>$p_year,
        'name'=>$p_name,
        'name_en'=>$p_name_en
    ];

    $last_id = $MMain->insertThis($raw);

    if(intval($last_id) > 0){
        $_SESSION['action_status']='success';
        $_SESSION['action_message']='Create project success.';
    }else{
        $_SESSION['action_status']='warning';
        $_SESSION['action_message']='Create project fail!!!';
    }
}
if($fn=='editMainProject'){
    $p_main_id = $MMain->getInput('mainProjectId');
    $p_year = $MMain->getInput('year');
    $p_name = $MMain->getInput('name');
    $p_name_en = $MMain->getInput('name_en');

    $raw = [
        'main_year'=>$p_year,
        'name'=>$p_name,
        'name_en'=>$p_name_en
    ];

    $condition = [
        'id'=>$p_main_id
    ];

    $last_id = $MMain->editThis($raw,$condition);

    if(intval($last_id) > 0){
        $_SESSION['action_status']='success';
        $_SESSION['action_message']='Edit project success.';
    }else{
        $_SESSION['action_status']='warning';
        $_SESSION['action_message']='Edit project fail!!!';
    }
}
elseif($fn=='modalActive'){

    $active_id = $MMain->getInput('active_id');
    $active_status = $MMain->getInput('status');

    $raw = [
        'main_status'=> strtoupper($active_status)
    ];
    $condition = [
        'id'=>$active_id
    ];

    $update_row = $MMain->editThis($raw,$condition);
    if($update_row >0){
        $_SESSION['action_status']='success';
        $_SESSION['action_message']='Active success.';

    }
    else{
        $_SESSION['action_status']='warning';
        $_SESSION['action_message']='Active fail!!!';
    }

}
elseif($fn=='modalDelete'){

    $delete_id = $MMain->getInput('delete_id',0);

    $condition = [
        'id'=>$delete_id
    ];


    $user_row = $MMain->deleteThis($condition);
    if($user_row >0){
        $_SESSION['action_status']='success';
        $_SESSION['action_message']='Delete Project success.';

    }
    else{
        $_SESSION['action_status']='warning';
        $_SESSION['action_message']='Delete Project fail!!!';
    }

}




$sql = " ORDER BY main_status ASC, main_year DESC , create_at DESC";
$result = $MMain->selectSqlAll($sql);
if(count($result)>0){
    $MAINS = $result;
}


