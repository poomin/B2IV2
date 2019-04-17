<?php
/**
 * Created by PhpStorm.
 * User: PF0T4E5G
 * Date: 8/4/2562
 * Time: 02:00 ก่อนเที่ยง
 */

require_once __DIR__.'/../model/WebModel.php';
$MWeb = new WebModel();


$WEB_INFORMATION = '';



//>>>>>>>>>>>>>>> in page

//web
$result = $MWeb->selectThis(['id'=>$SET_WEB]);
if(isset($result['web_info'])){
    $WEB_INFORMATION = $result['web_info'];
}




