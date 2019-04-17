<?php
/**
 * Created by PhpStorm.
 * User: PF0T4E5G
 * Date: 15/4/2562
 * Time: 11:37 หลังเที่ยง
 */
require_once __DIR__.'/../model/HallModel.php';

$MHall = new HallModel();


$hid = $MHall->getInput('hid',99999999999);
$this_project_name = '';
$this_project_name_en = '';
$this_image = '';
$this_adviser_name = '';
$this_student_1 = '';
$this_student_2 = '';
$this_student_3 ='';
$this_student_4 = '';
$this_detail = '';

$result = $MHall->selectThis(['id'=>$hid]);
if(isset($result['id'])){
    $this_project_name = $result['project_name'];
    $this_project_name_en = $result['project_name_en'];
    $this_image = $result['image'];
    $this_adviser_name = $result['adviser_name'];
    $this_student_1 = $result['student_1'];
    $this_student_2 = $result['student_2'];
    $this_student_3 = $result['student_3'];
    $this_student_4 = $result['student_4'];
    $this_detail = $result['detail'];
}