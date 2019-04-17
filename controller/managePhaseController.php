<?php
/**
 * Created by PhpStorm.
 * User: PF0T4E5G
 * Date: 16/4/2562
 * Time: 02:20 ก่อนเที่ยง
 */
require_once __DIR__.'/../model/MainProjectModel.php';
require_once __DIR__.'/../model/MainPhaseModel.php';

$MMain = new MainProjectModel();
$MPhase = new MainPhaseModel();


$this_main_id = '';
$this_main_year = '';
$this_main_name = '';
$this_main_name_en = '';

$this_sq = '';
$this_title = '';
$this_detail = '';
$this_doc = '';
$this_pdf = '';
$this_image = '';
$this_video = '';
$this_date_start = '';
$this_date_end = '';


$request_sq = $MMain->getInput('sq','');
$result = $MMain->selectThis(['main_status'=>'Y']);
if(isset($result['id'])){
    $this_main_id = $result['id'];
    $this_main_year = $result['main_year'];
    $this_main_name = $result['name'];
    $this_main_name_en = $result['name_en'];


    //phase
    if($request_sq==''){
        $result = $MPhase->selectThisAll(['main_id'=>$this_main_id]);
        $this_sq = count($result) + 1 ;
    }else{
        $this_sq = $request_sq;
        $result = $MPhase->selectThis(['main_id'=>$this_main_id,'sq'=>$this_sq]);
        if(isset($result['id'])){
            $this_title = $result['title'];
            $this_detail = $result['detail'];
            $this_doc = $result['upload_doc'];
            $this_pdf = $result['upload_pdf'];
            $this_image = $result['upload_image'];
            $this_video = $result['upload_video'];
            $this_date_start = $result['date_start'];
            $this_date_start = date('d/m/Y',strtotime($this_date_start));
            $this_date_end = $result['date_end'];
            $this_date_end = date('d/m/Y',strtotime($this_date_end));
        }

    }




}