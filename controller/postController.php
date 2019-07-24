<?php
/**
 * Created by PhpStorm.
 * User: PF0T4E5G
 * Date: 10/4/2562
 * Time: 12:05 ก่อนเที่ยง
 */

require_once __DIR__.'/../model/NewsModel.php';
$MNews = new NewsModel();

$NEWS = [];

$fn = $MNews->getInput('fn');
if($fn=='modalDelete'){

    $news_id = $MNews->getInput('delete_id',0);

    $condition = [
        'id'=>$news_id
    ];


    $user_row = $MNews->deleteThis($condition);
    if($user_row >0){
        $_SESSION['action_status']='success';
        $_SESSION['action_message']='Delete News success.';

    }
    else{
        $_SESSION['action_status']='warning';
        $_SESSION['action_message']='Delete News fail!!!';
    }

}
elseif($fn=='modalTack'){

    $news_id = $MNews->getInput('tack_id');
    $news_pin = $MNews->getInput('news_pin');

    $raw = [
        'news_pin'=> strtoupper($news_pin)
    ];
    $condition = [
        'id'=>$news_id
    ];

    $update_row = $MNews->editThis($raw,$condition);
    if($update_row >0){
        $_SESSION['action_status']='success';
        $_SESSION['action_message']='Tack news success.';

    }
    else{
        $_SESSION['action_status']='warning';
        $_SESSION['action_message']='Tack news fail!!!';
    }

}





$sql = " ORDER BY news_pin ASC , create_at DESC ";
$result = $MNews->selectSqlAll($sql);
if(count($result)>0){
    $NEWS = $result;
}