<?php
/**
 * Created by PhpStorm.
 * User: PF0T4E5G
 * Date: 10/4/2562
 * Time: 01:24 ก่อนเที่ยง
 */

require_once __DIR__.'/../model/NewsModel.php';
$MNews = new NewsModel();

$NEWS = [];



$sql = " ORDER BY news_pin ASC , create_at DESC LIMIT 10 ";
$result = $MNews->selectSqlAll($sql);
if(count($result)>0){
    $NEWS = $result;
}