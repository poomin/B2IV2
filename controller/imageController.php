<?php
/**
 * Created by PhpStorm.
 * User: PF0T4E5G
 * Date: 8/4/2562
 * Time: 11:20 หลังเที่ยง
 */
require_once __DIR__.'/../model/WebImageModel.php';
$MWebImage = new WebImageModel();

$IMAGES = [];

$fn = $MWebImage->getInput('fn');
if($fn=='modalDelete'){

    $image_id = $MWebImage->getInput('delete_id');

    $condition = [
        'id'=>$image_id
    ];


    $image_row = $MWebImage->deleteThis($condition);
    if($image_row >0){
        $_SESSION['action_status']='success';
        $_SESSION['action_message']='Delete school success.';

    }
    else{
        $_SESSION['action_status']='warning';
        $_SESSION['action_message']='Delete school fail!!!';
    }

}

//>>>>>>>>>>>>>>> in page

//image
$result = $MWebImage->selectThisAll([]);
if(count($result)>0){
    $IMAGES = $result;
}

