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
require_once __DIR__.'/../model/UserModel.php';

$MMain = new MainProjectModel();
$MMPhase = new MainPhaseModel();
$MMBoard = new MainBoardModel();
$MMScore = new MainScoreModel();

$MPro = new ProjectModel();
$MSchool = new SchoolModel();
$MPhase = new ProjectPhaseModel();
$MUpload = new ProjectUploadModel();
$MScore = new ProjectScoreModel();
$MUser = new UserModel();

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
$this_phase_status = 'NON';
$this_phase_message = '';
$this_phase_score_start = (date('Y-m-d'));
$this_phase_score_end = (date('Y-m-d'));


$BOARD = [];

if($this_pro_id =='0' || $this_pro_id =='0' ){
    header( "location: /lrate.php" );
    exit(0);
}



//======================= function ================
$fn = $MPro->getInput('fn');
if($fn=='sendPhase'){
    $input_status = $MPhase->getInput('phase_status');
    $input_message = $MPhase->getInput('message');
    $input_p_id = $this_pro_id;
    $input_p_sq = $this_pro_sq;

    $result = $MPhase->insertUpdateThis(
        ['project_id'=>$input_p_id , 'sq'=>$input_p_sq ,'message'=>$input_message ,'phase_status'=>$input_status],
        ['message'=>$input_message ,'phase_status'=>$input_status]
    );

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

    $result = $MMPhase->selectThis(['main_id'=>$this_main_id , 'sq'=>$this_pro_sq]);
    if(isset($result['id'])){
        $this_phase_name = $result['title'];
        $this_phase_score_start = $result['score_date_start'];
        $this_phase_score_end = $result['score_date_end'];
    }
    else{
        header( "location: /lrate.php" );
        exit(0);
    }

    $result = $MPhase->selectThis(['project_id'=>$this_pro_id , 'sq'=>$this_pro_sq]);
    if(isset($result['id'])){
        $this_phase_status = $result['phase_status'];
        $this_phase_message = $result['message'];
    }

    $KEY_BOARD = [];
    $result = $MUser->selectThisAll(['role'=>'board']);
    if(count($result)>0){
        foreach ($result as $item) {
            $KEY_BOARD[$item['id']] = $item;
        }
    }

    $result = $MMBoard->selectThisAll(['main_id'=>$this_main_id , 'sq'=>$this_pro_sq]);
    if(count($result) > 0){
        $BOARD = $result;
    }

    $SCORE_DETAIL = $MMScore->selectThisAll(['main_id'=>$this_main_id , 'sq'=>$this_pro_sq]);


    foreach ($BOARD as $key=>$item){
        $BOARD[$key]['name_title'] = '';
        $BOARD[$key]['name'] = '';
        $BOARD[$key]['surname'] = '';
        $BOARD[$key]['schoolname'] = '';

        $i_user_id = $item['user_id'];

        if(isset($KEY_BOARD[$i_user_id]['id'])){
            $BOARD[$key]['name_title'] = $KEY_BOARD[$i_user_id]['name_title'];
            $BOARD[$key]['name'] = $KEY_BOARD[$i_user_id]['name'];
            $BOARD[$key]['surname'] = $KEY_BOARD[$i_user_id]['surname'];
            $BOARD[$key]['schoolname'] = $KEY_BOARD[$i_user_id]['schoolname'];
        }


        $BOARD[$key]['scores'] = [];
        $SCORES = [];
        if(count($SCORE_DETAIL) >0){
            $SCORES = $SCORE_DETAIL;
            foreach ($SCORES as $k => $i){
                $result = $MScore->selectThis(['main_score_id'=>$i['id'] , 'project_id'=>$this_pro_id]);
                if(isset($result['id'])){
                    $SCORES[$k]['score'] = $result['score'];
                }else{
                    $SCORES[$k]['score'] = '';
                }
            }
            $BOARD[$key]['scores'] = $SCORES;
        }

    }


}
else{
    header( "location: /lrate.php" );
    exit(0);
}