<?php
/**
 * Created by PhpStorm.
 * User: PF0T4E5G
 * Date: 8/4/2562
 * Time: 02:00 ก่อนเที่ยง
 */

require_once __DIR__.'/../model/WebModel.php';
require_once __DIR__.'/../model/WebImageModel.php';
$MWebImage = new WebImageModel();
$MWeb = new WebModel();


$WEB_HOME = '';
$IMAGES = [];


//>>>>>>>>>>>>>>> in page

//web
$result = $MWeb->selectThis(['id'=>$SET_WEB]);
if(isset($result['web_home'])){
    $WEB_HOME = $result['web_home'];
}

//image
$result = $MWebImage->selectThisAll([]);
if(count($result)>0){
    $IMAGES = $result;
}




