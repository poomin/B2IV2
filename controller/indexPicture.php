<?php
/**
 * Created by PhpStorm.
 * User: PF0T4E5G
 * Date: 15/4/2562
 * Time: 09:51 หลังเที่ยง
 */

require_once __DIR__.'/../model/PictureModel.php';
require_once __DIR__.'/../model/PicturesModel.php';

$MPic = new PictureModel();
$MPics = new PicturesModel();

$ACTIVITY = [];

$sql = ' ORDER BY create_at DESC LIMIT 9 ';
$result = $MPic->selectSqlAll($sql);
if(count($result)>0){
    $ACTIVITY = $result;
    foreach ($ACTIVITY as $key=>$item){
        $ACTIVITY[$key]["pictures"] = [];
        $sql = ' ORDER BY create_at DESC LIMIT 3 ';
        $result = $MPics->selectSqlAll($sql);
        if(count($result)>0){
            $ACTIVITY[$key]["pictures"] = $result;
        }
    }
}

//echo json_encode($ACTIVITY);exit;

