<?php
/**
 * Created by PhpStorm.
 * User: PF0T4E5G
 * Date: 15/4/2562
 * Time: 11:37 หลังเที่ยง
 */
require_once __DIR__.'/../model/PictureModel.php';
require_once __DIR__.'/../model/PicturesModel.php';

$MPic = new PictureModel();
$MPics = new PicturesModel();

$this_title = '';
$this_detail = '';
$this_date = '';
$PICTURES = [];

$pid = $MPic->getInput('hid',0);

$result = $MPic->selectThis(['id'=>$pid]);
if(isset($result['id'])){
    $this_title = $result['title'];
    $this_detail = $result['detail'];
    $this_date = date("d/m/Y",strtotime($result['create_at']));

    $result = $MPics->selectThisAll(['activity_id'=>$pid]);
    if(count($result)>0){
        $PICTURES = $result;
    }
}
//echo json_encode($PICTURES);exit;