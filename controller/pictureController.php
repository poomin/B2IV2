<?php
/**
 * Created by PhpStorm.
 * User: PF0T4E5G
 * Date: 10/4/2562
 * Time: 12:05 ก่อนเที่ยง
 */

require_once __DIR__.'/../model/PictureModel.php';
$MPicture = new PictureModel();

$PICTURES = [];

$fn = $MPicture->getInput('fn');
if($fn=='create'){

    $title = $MPicture->getInput('title');

    $raw = [
        'title'=>$title
    ];

    $last_id = $MPicture->insertThis($raw);
    if($last_id >0){
        header( "location: /lpicture-edit.php?pid=".$last_id );
        exit(0);
    }
    else{
        $_SESSION['action_status']='warning';
        $_SESSION['action_message']='Create picture fail!!!';
    }

}
elseif ($fn=='modalDelete'){
    $news_id = $MPicture->getInput('delete_id',0);

    $condition = [
        'id'=>$news_id
    ];


    $user_row = $MPicture->deleteThis($condition);
    if($user_row >0){
        $_SESSION['action_status']='success';
        $_SESSION['action_message']='Delete success.';
    }
    else{
        $_SESSION['action_status']='warning';
        $_SESSION['action_message']='Delete fail!!!';
    }

}





$sql = " ORDER BY create_at DESC ";
$result = $MPicture->selectSqlAll($sql);
if(count($result)>0){
    $PICTURES = $result;
}