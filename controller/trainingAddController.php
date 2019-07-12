<?php
/**
 * Created by PhpStorm.
 * User: PF0T4E5G
 * Date: 9/4/2562
 * Time: 11:37 หลังเที่ยง
 */

require_once __DIR__.'/../model/MainProjectModel.php';
require_once __DIR__.'/../model/MainPhaseModel.php';
require_once __DIR__.'/../model/MainTrainingModel.php';


$MMain = new MainProjectModel();
$MPhase = new MainPhaseModel();
$MTraining  = new MainTrainingModel();

function formatDate($dmy,$df=''){
   $cut =  explode("/",$dmy);
   if(count($cut)==3){
       return $cut[2].'-'.$cut[1].'-'.$cut[0];
   }else{
       return $df;
   }
}
function formatDateDmy($dmy,$df=''){
    $cut =  explode("-",$dmy);
    if(count($cut)==3){
        return $cut[2].'/'.$cut[1].'/'.$cut[0];
    }else{
        return $df;
    }
}


//------------------ function
$fn = $MMain->getInput('fn');
if($fn=='addTraining'){

    $raw = [
        'main_id'=>$MMain->getInput('main_id'),
        'sq'=>$MMain->getInput('sq'),
        'training_title'=>$MMain->getInput('training_title'),
        'training_detail'=>$MMain->getInput('training_detail'),
        'state_list'=>$MMain->getInput('state_list'),
        'shirt_active'=>$MMain->getInput('shirt_active'),
        'shirt_list'=>$MMain->getInput('shirt_list'),
        'training_group'=>$MMain->getInput('training_group'),
        'checkin_active'=>$MMain->getInput('checkin_active'),
        'checkin_detail'=>$MMain->getInput('checkin_detail'),
        'date_start'=> formatDate($MMain->getInput('date_start')),
        'date_end'=> formatDate($MMain->getInput('date_end')),
    ];

    $lastId = $MTraining->insertThis($raw);
    if($lastId>0){
        $_SESSION['action_status']='success';
        $_SESSION['action_message']='Add Training success.';
        header( "location: /ltraining-add.php?tid=".$lastId );
        exit(0);
    }else{
        $_SESSION['action_status']='error';
        $_SESSION['action_message']='Add Training Fail!!';
    }
}
elseif($fn=='editTraining'){

    $tid = $MMain->getInput('tid','');
    $raw = [
        'main_id'=>$MMain->getInput('main_id'),
        'sq'=>$MMain->getInput('sq'),
        'training_title'=>$MMain->getInput('training_title'),
        'training_detail'=>$MMain->getInput('training_detail'),
        'state_list'=>$MMain->getInput('state_list'),
        'shirt_active'=>$MMain->getInput('shirt_active'),
        'shirt_list'=>$MMain->getInput('shirt_list'),
        'training_group'=>$MMain->getInput('training_group'),
        'checkin_active'=>$MMain->getInput('checkin_active'),
        'checkin_detail'=>$MMain->getInput('checkin_detail'),
        'date_start'=> formatDate($MMain->getInput('date_start')),
        'date_end'=> formatDate($MMain->getInput('date_end')),
    ];

    $lastId = $MTraining->editThis($raw,['id'=>$tid]);
    if($lastId>0){
        $_SESSION['action_status']='success';
        $_SESSION['action_message']='Edit Training success.';
    }else{
        $_SESSION['action_status']='error';
        $_SESSION['action_message']='Edit Training Fail!!';
    }
}

//main
$this_main_pro_id = '';
$this_main_pro_name = '';
//phase
$PHASE = [];
//training
$this_t_id = '';
$this_t_sq = '';
$this_t_title = '';
$this_t_detail = '';
$this_t_state = [];
$this_t_shirt = 'Y';
$this_t_shirts = [];
$this_t_group = 'PASS';
$this_t_start = '';
$this_t_end = '';

$this_checkIn_status = 'N';
$this_checkIn_detail = '';


$result = $MMain->selectThis(['main_status'=>'Y']);
if(isset($result['id'])){
    $this_main_pro_id = $result['id'];
    $this_main_pro_name = $result['name'];

    //main phase
    $result = $MPhase->selectThisAll(['main_id'=>$this_main_pro_id]);
    if(count($result)>0){
        $PHASE = $result;
    }

}
else{
    header( "location: /ltraining.php" );
    exit(0);
}

$tid = $MMain->getInput('tid','');
if($tid!=''){
    $result = $MTraining->selectThis(['id'=>$tid]);
    if(isset($result['id'])){

        $this_t_id = $result['id'];
        $this_t_sq = $result['sq'];
        $this_t_title = $result['training_title'];
        $this_t_detail = $result['training_detail'];
        $this_t_shirt = $result['shirt_active'];
        $this_t_group = $result['training_group'];
        $this_t_start = formatDateDmy($result['date_start']);
        $this_t_end = formatDateDmy($result['date_end']);

        $this_checkIn_status = $result['checkin_active'];
        $this_checkIn_detail = $result['checkin_detail'];

        if($result['state_list']!=''){
            $i_state = $result['state_list'];
            $this_t_state = explode(':',$i_state);
        }

        if($result['shirt_list']!=''){
            $i_shirt = $result['shirt_list'];
            $this_t_shirts = explode(':',$i_shirt);
        }

    }
}



