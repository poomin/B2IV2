<?php
/**
 * Created by PhpStorm.
 * User: PF0T4E5G
 * Date: 15/4/2562
 * Time: 12:09 ก่อนเที่ยง
 */
require_once __DIR__.'/../model/HallModel.php';
$MHall = new HallModel();

$HALLS = [];

$fn = $MHall->getInput('fn');


if($fn=='modalDelete'){

    $hall_id = $MHall->getInput('delete_id');

    $condition = [
        'id'=>$hall_id
    ];


    $delete_row = $MHall->deleteThis($condition);
    if($delete_row >0){
        $_SESSION['action_status']='success';
        $_SESSION['action_message']='Delete Hall success.';

    }
    else{
        $_SESSION['action_status']='warning';
        $_SESSION['action_message']='Delete Hall fail!!!';
    }

}




$sql = ' ORDER BY create_at DESC ';
$result = $MHall->selectSqlAll($sql);
if(count($result)>0){
    $HALLS = $result;
}