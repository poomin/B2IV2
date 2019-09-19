<?php
/**
 * Created by PhpStorm.
 * User: PF0T4E5G
 * Date: 15/4/2562
 * Time: 09:51 หลังเที่ยง
 */

require_once __DIR__.'/../model/VideoModel.php';
require_once __DIR__.'/../model/VideosModel.php';

$MVideo = new VideoModel();
$MVideos = new VideosModel();

$ACTIVITY = [];

$sql = ' ORDER BY create_at DESC LIMIT 10 ';
$result = $MVideo->selectSqlAll($sql);
if(count($result)>0){
    $ACTIVITY = $result;
    foreach ($ACTIVITY as $key=>$item){
        $ACTIVITY[$key]["video"] = '';
        $sql = ' WHERE activity_id= '.$item['id'].' ORDER BY create_at DESC LIMIT 1 ';
        $result = $MVideos->selectSqlAll($sql);
        if(count($result)>0){
            $ACTIVITY[$key]["video"] = $result[0]['video_path'];
        }
    }
}

//echo json_encode($ACTIVITY);exit;

