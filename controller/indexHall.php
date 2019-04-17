<?php
/**
 * Created by PhpStorm.
 * User: PF0T4E5G
 * Date: 15/4/2562
 * Time: 09:51 หลังเที่ยง
 */

require_once __DIR__.'/../model/HallModel.php';
$MHall = new HallModel();

$HALLS = [];

$sql = ' ORDER BY create_at DESC LIMIT 9 ';
$result = $MHall->selectSqlAll($sql);
if(count($result)>0){
    $HALLS = $result;
}

