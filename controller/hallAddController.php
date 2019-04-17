<?php
/**
 * Created by PhpStorm.
 * User: PF0T4E5G
 * Date: 14/4/2562
 * Time: 11:46 หลังเที่ยง
 */
require_once __DIR__.'/../model/HallModel.php';

$MHall = new HallModel();

$this_hall_id = $MHall->getInput('hid');
$this_image = '/upload/news/null.png';
$this_project_name = '';
$this_project_name_en = '';
$this_adviser = '';
$this_student_1 = '';
$this_student_2 = '';
$this_student_3 = '';
$this_student_4 = '';
$this_detail = '';
if($this_hall_id!=''){
    $result = $MHall->selectThis(['id'=>$this_hall_id]);
    if(isset($result['id'])){
        $this_image = $result['image']==''?'/upload/news/null.png':$result['image'];
        $this_project_name = $result['project_name'];
        $this_project_name_en = $result['project_name_en'];
        $this_adviser = $result['adviser_name'];
        $this_student_1 = $result['student_1'];
        $this_student_2 = $result['student_2'];
        $this_student_3 = $result['student_3'];
        $this_student_4 = $result['student_4'];
        $this_detail = $result['detail'];
    }
}



