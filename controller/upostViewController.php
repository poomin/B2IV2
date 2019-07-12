<?php
require_once __DIR__.'/../model/MainProjectModel.php';
require_once __DIR__.'/../model/MainTrainingModel.php';

require_once __DIR__.'/../model/ProjectMemberModel.php';
require_once __DIR__.'/../model/ProjectPhaseModel.php';

require_once __DIR__.'/../model/TrainingModel.php';
require_once __DIR__.'/../model/TrainingMemberModel.php';

require_once __DIR__.'/../model/UserModel.php';

$MMain = new MainProjectModel();
$MMTrain = new MainTrainingModel();

$MPMember = new ProjectMemberModel();
$MPPhase = new ProjectPhaseModel();

$MTrain = new TrainingModel();
$MTMember = new TrainingMemberModel();

$MUser = new UserModel();

$LOGIN_USER_ID = isset($LOGIN_USER_ID)?$LOGIN_USER_ID:0;


$this_training_id = $MMain->getInput('tid',0);


$TEACHER = [];
$STUDENT = [];
$STATE = [];
$SHIRT_SIZE = [];
$T_UPDATE = true;

$this_m_t_id = 0;

$this_t_start = '';
$this_t_end = '';
$this_t_detail = '';
$this_t_shirt = '';
$this_t_shirts = '';
$this_t_states = '';
$this_t_group = '';
$this_t_sq = '';


$this_t_id = '';
$this_t_confirm = 'Y';
$this_t_note = '';
$this_t_driver = '';
$this_t_status = '';
$this_t_state = '';

$this_checkin_active = 'N';
$this_checkin_detail = '';

$c_d = date('d');
$c_m = date('m');
$c_y = date('Y');
$c_h = date('H');
$c_n = date('i');


$result = $MMain->selectThis(['main_status'=>'Y']);
if(isset($result['id'])) {
    $this_m_pro_id = $result['id'];


    $result = $MTrain->selectThis(['id'=>$this_training_id]);
    if(isset($result['id'])){
        $this_m_t_id = $result['main_training_id'];
        $this_t_id = $result['id'];
        $this_t_confirm = $result['training_confirm'];
        $this_t_note = $result['note'];
        $this_t_driver = $result['driver'];
        $this_t_status = $result['training_status'];
        $this_t_state = $result['training_state'];

        $dateTime = $result['checkin_datetime'];
        $cutDateTime = explode(" ",$dateTime);
        if(count($cutDateTime)>1){
            $dmy = $cutDateTime[0];
            $hn = $cutDateTime[1];
            $cutDmy = explode("-",$dmy);
            $cutHn = explode(":",$hn);
            $c_d = $cutDmy[0];
            $c_m = $cutDmy[1];
            $c_y = $cutDmy[2];
            $c_h = $cutHn[0];
            $c_n = $cutHn[1];
        }
    }


    //main training
    $result = $MMTrain->selectThis(['id'=>$this_m_t_id]);
    if(isset($result['id'])){
        $this_t_start = $result['date_start'];
        $this_t_end = $result['date_end'];
        $this_t_detail = $result['training_detail'];
        $this_t_shirt = $result['shirt_active'];
        $this_t_shirts = $result['shirt_list'];
        $this_t_states = $result['state_list'];
        $this_t_group = $result['training_group'];
        $this_t_sq = $result['sq'];
        $this_checkin_active = $result['checkin_active'];
        $this_checkin_detail = $result['checkin_detail'];
    }
    else{
        header( "location: /upost.php" );
        exit(0);
    }

    //state , size shirt
    $STATE = explode(':',$this_t_states);
    $SHIRT_SIZE = explode(':',$this_t_shirts);


    $STUDENT = [];
    $TEACHER = [];

    $result = $MTMember->selectAllThis(['training_id'=>$this_training_id]);
    foreach ($result as $key=>$item){
        if($item['member_type']=='TEACHER'){
            $TEACHER[] = $item;
        }else{
            $STUDENT[] = $item;
        }
    }

}



