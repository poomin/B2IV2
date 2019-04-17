<?php
/**
 * Created by PhpStorm.
 * User: PF0T4E5G
 * Date: 16/4/2562
 * Time: 02:20 ก่อนเที่ยง
 */

function formatDmy($dmy){
    $cut = explode('/',$dmy);
    if(count($cut)>=2){
        return $cut[2].'-'.$cut[1].'-'.$cut[0];
    }else{
        return date('Y-m-d');
    }
}
require_once __DIR__.'/../model/MainProjectModel.php';
require_once __DIR__.'/../model/MainPhaseModel.php';
require_once __DIR__.'/../model/MainScoreModel.php';
require_once __DIR__.'/../model/MainBoardModel.php';
require_once __DIR__.'/../model/UserModel.php';

$MMain = new MainProjectModel();
$MPhase = new MainPhaseModel();
$MScore = new MainScoreModel();
$MBoard = new MainBoardModel();
$MUser = new UserModel();

$fn = $MMain->getInput('fn','');

if($fn == 'modalDelete'){
    $delete_id = $MMain->getInput('delete_id');
    $cut = explode('-',$delete_id);

    $delete_rows = 0;
    if(count($cut)>0){
        $condition = [
            'id'=>$cut[1]
        ];

        if($cut[0]=='score'){
            $delete_rows = $MScore->deleteThis($condition);
        }
        elseif ($cut[0]=='board'){
            $delete_rows = $MBoard->deleteThis($condition);
        }
    }

    if($delete_rows >0){
        $_SESSION['action_status']='success';
        $_SESSION['action_message']='Delete success.';

    }
    else{
        $_SESSION['action_status']='warning';
        $_SESSION['action_message']='Delete fail!!!';
    }

}

elseif($fn == 'addScore'){
    $p_main_id = $MScore->getInput('main_id');
    $p_sq = $MScore->getInput('sqS');
    $p_score_text = $MScore->getInput('score_text');
    $p_score_point = $MScore->getInput('score_point');

    $raw = [
      'main_id'=>$p_main_id,
      'sq'=>$p_sq,
      'score_text'=>$p_score_text,
      'score_point'=>$p_score_point,
    ];


    $insert_rows = $MScore->insertThis($raw);
    if($insert_rows >0){
        $_SESSION['action_status']='success';
        $_SESSION['action_message']='Save success.';
    }
    else{
        $_SESSION['action_status']='warning';
        $_SESSION['action_message']='Save fail!!!';
    }
}
elseif($fn == 'editScore'){

    $p_score_id = $MScore->getInput('score_id');
    $p_score_text = $MScore->getInput('score_text');
    $p_score_point = $MScore->getInput('score_point');

    $raw = [
        'score_text'=>$p_score_text,
        'score_point'=>$p_score_point,
    ];
    $condition = [
      'id'=>$p_score_id
    ];

    $update_rows = $MScore->editThis($raw,$condition);
    if($update_rows >0){
        $_SESSION['action_status']='success';
        $_SESSION['action_message']='Edit success.';
    }
    else{
        $_SESSION['action_status']='warning';
        $_SESSION['action_message']='Edit fail!!!';
    }
}

elseif($fn == 'updatePhase'){

    $p_phase_id = $MPhase->getInput('phase_id');
    $p_date_start = $MPhase->getInput('dateStart');
    $p_date_start = formatDmy($p_date_start);
    $p_date_stop = $MPhase->getInput('dateStop');
    $p_date_stop = formatDmy($p_date_stop);

    $raw = [
        'score_date_start'=>$p_date_start,
        'score_date_end'=>$p_date_stop,
    ];

    $condition = [
        'id'=>$p_phase_id
    ];

    $update_rows = $MPhase->editThis($raw,$condition);
    if($update_rows >0){
        $_SESSION['action_status']='success';
        $_SESSION['action_message']='Edit success.';
    }
    else{
        $_SESSION['action_status']='warning';
        $_SESSION['action_message']='Edit fail!!!';
    }
}

elseif($fn == 'addBoard'){
    $p_main_id = $MBoard->getInput('main_id');
    $p_sq = $MBoard->getInput('sqS');
    $p_user_id = $MBoard->getInput('user_id');


    $raw = [
        'main_id'=>$p_main_id,
        'sq'=>$p_sq,
        'user_id'=>$p_user_id
    ];


    $insert_rows = $MBoard->insertThis($raw);
    if($insert_rows >0){
        $_SESSION['action_status']='success';
        $_SESSION['action_message']='Save success.';
    }
    else{
        $_SESSION['action_status']='warning';
        $_SESSION['action_message']='Save fail!!!';
    }
}


$SCORES = [];
$BOARDS = [];
$USERS = [];

$this_main_id = '';
$this_main_year = '';
$this_main_name = '';
$this_main_name_en = '';

$this_phase_id = '';
$this_sq = '';
$this_title = '';
$this_detail = '';
$this_date_start = '';
$this_date_end = '';


$result = $MUser->selectThisAll(['role'=>'board']);
if(count($result)>0){
    $USERS = $result;
}

$request_sq = $MMain->getInput('sq','0');
$result = $MMain->selectThis(['main_status'=>'Y']);
if(isset($result['id'])){
    $this_main_id = $result['id'];
    $this_main_year = $result['main_year'];
    $this_main_name = $result['name'];
    $this_main_name_en = $result['name_en'];


    //phase
    $this_sq = $request_sq;
    $result = $MPhase->selectThis(['main_id'=>$this_main_id,'sq'=>$this_sq]);
    if(isset($result['id'])){
        $this_phase_id = $result['id'];
        $this_title = $result['title'];
        $this_detail = $result['detail'];
        if($result['score_date_start']!=''){
            $this_date_start = date('d/m/Y',strtotime($result['score_date_start']));
        }
        if($result['score_date_end']!=''){
            $this_date_end = date('d/m/Y',strtotime($result['score_date_end']));
        }
    }

    //score
    $result = $MScore->selectThisAll(['main_id'=>$this_main_id,'sq'=>$this_sq]);
    if(count($result)>0){
        $SCORES = $result;
    }

    $result = $MBoard->selectAllBoard($this_main_id,$this_sq);
    if(count($result)>0){
        $BOARDS = $result;
    }




}