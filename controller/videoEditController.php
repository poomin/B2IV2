<?php
/**
 * Created by PhpStorm.
 * User: PF0T4E5G
 * Date: 8/4/2562
 * Time: 11:20 หลังเที่ยง
 */
require_once __DIR__.'/../model/VideoModel.php';
require_once __DIR__.'/../model/VideosModel.php';
$MVideo = new VideoModel();
$MVideos = new VideosModel();

$VIDEOS = [];
$SET_VIDEO_ID = $MVideo->getInput('vid',0);
$this_title = '';
$this_detail = '';


// >>>>>>>>>>>>> function active
$fn = $MVideos->getInput('fn');
if($fn=='modalDelete'){

    $video_id = $MVideos->getInput('delete_id',0);

    $condition = [
        'id'=>$video_id
    ];


    $image_row = $MVideos->deleteThis($condition);
    if($image_row >0){
        $_SESSION['action_status']='success';
        $_SESSION['action_message']='Delete school success.';

    }
    else{
        $_SESSION['action_status']='warning';
        $_SESSION['action_message']='Delete school fail!!!';
    }

}

elseif ($fn=='editVideo') {
    $this_title = $MVideo->getInput('title');
    $this_detail = $MVideo->getInput('detail');

    $raws = [
        'title' => $this_title,
        'detail' => $this_detail
    ];
    $condition = [
        'id' => $SET_VIDEO_ID
    ];

    $user_row = $MVideo->editThis($raws,$condition);
    if($user_row >0){
        $_SESSION['action_status']='success';
        $_SESSION['action_message']='Edit success.';
    }
    else{
        $_SESSION['action_status']='warning';
        $_SESSION['action_message']='Edit fail!!!';
    }

}

elseif ($fn=='addVideo') {
    $this_video_path = $MVideos->getInput('src');

    $raws = [
        'activity_id' => $SET_VIDEO_ID,
        'video_path' => $this_video_path
    ];

    $user_row = $MVideos->insertThis($raws);
    if($user_row >0){
        $_SESSION['action_status']='success';
        $_SESSION['action_message']='Add Embed success.';
    }
    else{
        $_SESSION['action_status']='warning';
        $_SESSION['action_message']='Add Embed fail!!!';
    }

}

// >>>>>>>>>>>>> in page
//picture
$result = $MVideo->selectThis(['id'=> $SET_VIDEO_ID]);
if(isset($result['id'])){
    $this_title = $result['title'];
    $this_detail = $result['detail'];
}

//image
$result = $MVideos->selectThisAll(['activity_id'=>$SET_VIDEO_ID]);
if(count($result)>0){
    $VIDEOS = $result;
}

