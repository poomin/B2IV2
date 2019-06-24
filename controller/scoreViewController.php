<?php
/**
 * Created by PhpStorm.
 * User: PF0T4E5G
 * Date: 19/4/2562
 * Time: 01:15 ก่อนเที่ยง
 */

require_once __DIR__.'/../model/MainProjectModel.php';
require_once __DIR__.'/../model/MainPhaseModel.php';
require_once __DIR__.'/../model/MainBoardModel.php';
require_once __DIR__.'/../model/MainScoreModel.php';

require_once __DIR__.'/../model/ProjectModel.php';
require_once __DIR__.'/../model/ProjectPhaseModel.php';
require_once __DIR__.'/../model/ProjectUploadModel.php';
require_once __DIR__.'/../model/ProjectScoreModel.php';
require_once __DIR__.'/../model/SchoolModel.php';

$MMain = new MainProjectModel();
$MMPhase = new MainPhaseModel();
$MMBoard = new MainBoardModel();
$MMScore = new MainScoreModel();

$MPro = new ProjectModel();
$MSchool = new SchoolModel();
$MPhase = new ProjectPhaseModel();
$MUpload = new ProjectUploadModel();
$MScore = new ProjectScoreModel();

$LOGIN_USER_ID = isset($LOGIN_USER_ID)?$LOGIN_USER_ID:0;

$this_pro_id = $MPro->getInput('pid','0');
$this_pro_sq = $MPro->getInput('sq','0');
$this_pro_name = '';
$this_pro_en = '';
$this_pro_school = '';
$this_pro_province = '';
$this_pro_address = '';

$this_main_id = '';
$this_main_year = '';
$this_main_name = '';
$this_main_name_en = '';

$this_phase_name = '';
$this_phase_score_now = (date('Y-m-d'));
$this_phase_score_start = (date('Y-m-d'));
$this_phase_score_end = (date('Y-m-d'));

$this_score_edit = false;
$SCORE = [];

$PHASE_STATUS['DOC'] = false;
$PHASE_STATUS['PDF'] = false;
$PHASE_STATUS['IMAGE'] = false;
$PHASE_STATUS['VIDEO'] = false;
$PHASES['DOC']= [];
$PHASES['PDF']= [];
$PHASES['IMAGE']= [];
$PHASES['VIDEO']= [];


//======================= function ================
$fn = $MPro->getInput('fn');
if($fn=='addScore'){
    $input_count = $MScore->getInput('count');
    for($i=1;$i<=$input_count;$i++){
        $input_score_point = $MScore->getInput('score_point_'.$i);
        $input_score_id = $MScore->getInput('score_id_'.$i);
        $result = $MScore->insertUpdateThis(
            ['main_score_id'=>$input_score_id , 'user_id'=>$LOGIN_USER_ID , 'project_id'=>$this_pro_id, 'score'=>$input_score_point],
            ['score'=>$input_score_point]);
    }

    $_SESSION['action_status']='success';
    $_SESSION['action_message']='Save score success.';
}


//-------------- data in page ---------------



$result = $MPro->selectThis(['id'=>$this_pro_id]);

if(isset($result['id'])){
    $this_pro_name = $result['name'];
    $this_pro_en = $result['name_en'];
    $this_pro_school = $result['project_school'];
    $this_main_id = $result['main_id'];
    $result = $MSchool->selectThis(['school_name'=>$result['project_school']]);
    if(isset($result['id'])){
        $this_pro_province = $result['province'];
        if(!($result['address']=='' || $result['address']=='-')){
            $this_pro_address .=" ".$result['address'];
        }
        if(!($result['subdistrict']=='' || $result['subdistrict']=='-')){
            $this_pro_address .=" ต.".$result['subdistrict'];
        }
        if(!($result['district']=='' || $result['district']=='-')){
            $this_pro_address .=" อ.".$result['district'];
        }
        if(!($result['province']=='' || $result['province']=='-')){
            $this_pro_address .=" จ.".$result['province'];
        }
        if(!($result['code']=='' || $result['code']=='-')){
            $this_pro_address .=" ".$result['code'];
        }
    }

    $result = $MMain->selectThis(['id'=>$this_main_id]);
    if(isset($result['id'])) {
        $this_main_id = $result['id'];
        $this_main_year = $result['main_year'];
        $this_main_name = $result['name'];
        $this_main_name_en = $result['name_en'];
    }

    $result = $MMBoard->selectThis(['main_id'=>$this_main_id , 'sq'=>$this_pro_sq , 'user_id'=>$LOGIN_USER_ID ]);
    if(isset($result['id'])){
        $this_score_edit = true;
    }

    $result = $MMPhase->selectThis(['main_id'=>$this_main_id , 'sq'=>$this_pro_sq]);
    if(isset($result['id'])){
        $this_phase_name = $result['title'];
        $PHASE_STATUS['DOC'] = $result['upload_doc']=='Y'?true:false;
        $PHASE_STATUS['PDF'] = $result['upload_pdf']=='Y'?true:false;
        $PHASE_STATUS['IMAGE'] = $result['upload_image']=='Y'?true:false;
        $PHASE_STATUS['VIDEO'] = $result['upload_video']=='Y'?true:false;

        $this_phase_score_start = $result['score_date_start'];
        $this_phase_score_end = $result['score_date_end'];
        if($this_score_edit &&
            (strtotime($this_phase_score_now) >= strtotime($this_phase_score_start) ) &&
            (strtotime($this_phase_score_now) <= strtotime($this_phase_score_end)) ){
            $this_score_edit = true;
        }else{
            $this_score_edit = false;
        }

    }
    else{
        header( "location: /lscore.php" );
        exit(0);
    }

    $result = $MMScore->selectThisAll(['main_id'=>$this_main_id , 'sq'=>$this_pro_sq]);
    if(count($result) > 0){
        $SCORE = $result;
        foreach ($SCORE as $key => $item){
            $result = $MScore->selectThis(['main_score_id'=>$item['id'] , 'project_id'=>$this_pro_id]);
            if(isset($result['id'])){
                $SCORE[$key]['score'] = $result['score'];
            }else{
                $SCORE[$key]['score'] = '';
            }
        }
    }

    $i_docs = [];
    $i_pdf = [];
    $i_image = [];
    $i_video = [];
    $result = $MPhase->selectThis(['project_id'=>$this_pro_id,'sq'=>$this_pro_sq]);
    if(isset($result['id'])){
        $i_phase_id = $result['id'];
        $result = $MUpload->selectThisAll(['phase_id'=>$i_phase_id]);
        foreach ($result as $k => $i){
            if( strtoupper($i['upload_type'])=='DOC'){
                $i_docs[] = $i;
            }
            elseif (strtoupper($i['upload_type'])=='PDF'){
                $i_pdf[] = $i;
            }
            elseif (strtoupper($i['upload_type'])=='IMAGE'){
                $i_image[] = $i;
            }
            elseif (strtoupper($i['upload_type'])=='VIDEO'){
                $i_video[] = $i;
            }
        }
    }
    $PHASES['DOC']= $i_docs;
    $PHASES['PDF']= $i_pdf;
    $PHASES['IMAGE']= $i_image;
    $PHASES['VIDEO']= $i_video;



}
else{
    header( "location: /lscore.php" );
    exit(0);
}