<?php
/**
 * Created by PhpStorm.
 * User: PF0T4E5G
 * Date: 8/4/2562
 * Time: 11:20 หลังเที่ยง
 */
require_once __DIR__.'/../model/PictureModel.php';
require_once __DIR__.'/../model/PicturesModel.php';
$MPic = new PictureModel();
$MPics = new PicturesModel();

$IMAGES = [];
$SET_PIC_ID = $MPic->getInput('pid',0);
$this_title = '';
$this_detail = '';


// >>>>>>>>>>>>> function active
$fn = $MPics->getInput('fn');
if($fn=='modalDelete'){

    $image_id = $MPics->getInput('delete_id',0);

    $condition = [
        'id'=>$image_id
    ];


    $image_row = $MPics->deleteThis($condition);
    if($image_row >0){
        $_SESSION['action_status']='success';
        $_SESSION['action_message']='Delete school success.';

    }
    else{
        $_SESSION['action_status']='warning';
        $_SESSION['action_message']='Delete school fail!!!';
    }

}

elseif ($fn=='editPicture') {
    $this_title = $MPic->getInput('title');
    $this_detail = $MPic->getInput('detail');

    $raws = [
        'title' => $this_title,
        'detail' => $this_detail
    ];
    $condition = [
        'id' => $SET_PIC_ID
    ];

    $user_row = $MPic->editThis($raws,$condition);
    if($user_row >0){
        $_SESSION['action_status']='success';
        $_SESSION['action_message']='Edit success.';
    }
    else{
        $_SESSION['action_status']='warning';
        $_SESSION['action_message']='Edit fail!!!';
    }

}

// >>>>>>>>>>>>> in page
//picture
$result = $MPic->selectThis(['id'=> $SET_PIC_ID]);
if(isset($result['id'])){
    $this_title = $result['title'];
    $this_detail = $result['detail'];
}

//image
$result = $MPics->selectThisAll(['activity_id'=>$SET_PIC_ID]);
if(count($result)>0){
    $IMAGES = $result;
}

