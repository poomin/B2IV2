<?php
/**
 * Created by PhpStorm.
 * User: PF0T4E5G
 * Date: 15/4/2562
 * Time: 11:37 หลังเที่ยง
 */
require_once __DIR__.'/../model/VideoModel.php';
require_once __DIR__.'/../model/VideosModel.php';

$MVideo = new VideoModel();
$MVideos = new VideosModel();

$this_title = '';
$this_detail = '';
$this_date = '';
$VIDEOS = [];

$pid = $MVideo->getInput('vid',0);

$result = $MVideo->selectThis(['id'=>$pid]);
if(isset($result['id'])){
    $this_title = $result['title'];
    $this_detail = $result['detail'];
    $this_date = date("d/m/Y",strtotime($result['create_at']));

    $result = $MVideos->selectThisAll(['activity_id'=>$pid]);
    if(count($result)>0){
        $VIDEOS = $result;
    }
}
//echo json_encode($PICTURES);exit;