<?php
/**
 * Created by PhpStorm.
 * User: PF0T4E5G
 * Date: 10/4/2562
 * Time: 12:05 ก่อนเที่ยง
 */

require_once __DIR__.'/../model/VideoModel.php';
$MVideo = new VideoModel();

$VIDEOS = [];

$fn = $MVideo->getInput('fn');
if($fn=='create'){

    $title = $MVideo->getInput('title');

    $raw = [
        'title'=>$title
    ];

    $last_id = $MVideo->insertThis($raw);
    if($last_id >0){
        header( "location: /lvideo-edit.php?vid=".$last_id );
        exit(0);
    }
    else{
        $_SESSION['action_status']='warning';
        $_SESSION['action_message']='Create picture fail!!!';
    }

}
elseif ($fn=='modalDelete'){
    $news_id = $MVideo->getInput('delete_id',0);

    $condition = [
        'id'=>$news_id
    ];


    $user_row = $MVideo->deleteThis($condition);
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
$result = $MVideo->selectSqlAll($sql);
if(count($result)>0){
    $VIDEOS = $result;
}