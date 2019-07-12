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


$this_m_t_id = $MMain->getInput('tid',0);
$this_pro_id = $MMain->getInput('pid',0);


$fn = $MMain->getInput('fn');
if($fn=='addConfirmPass'){
    $jsonTraining = $MMain->getInput('training');
    $it = json_decode($jsonTraining,true);

    $jsonMember = $MMain->getInput('member');
    $im = json_decode($jsonMember,true);

    $rawInsert = [
        'main_training_id'=> $it['main_training_id'],
        'project_id'=> $it['project_id'],
        'training_confirm'=> $it['training_confirm'],
        'training_status'=> 'PASS',
        'training_state'=> $it['training_state'],
        'checkin_datetime'=> $it['checkin_datetime'],
        'driver'=>$it['driver']
    ];
    $rawUpdate = [
        'training_confirm'=> $it['training_confirm'],
        'training_status'=> 'PASS',
        'training_state'=> $it['training_state'],
        'checkin_datetime'=> $it['checkin_datetime'],
        'driver'=>$it['driver']
    ];
    $lastId = $MTrain->insertUpdateThis($rawInsert,$rawUpdate);
    $result = $MTrain->selectThis(['main_training_id'=> $it['main_training_id'],'project_id'=> $it['project_id']]);
    if(isset($result['id'])){
        $lastId = $result['id'];
    }

    foreach ($im as $key=>$item){
        $rawInsert = [
            'training_id'=> $lastId,
            'user_id'=> $item['user_id'],
            'member_type'=> $item['member_type'],
            'name_title'=> $item['name_title'],
            'name'=> $item['name'],
            'surname'=> $item['surname'],
            'member_class'=> $item['member_class'],
            'phone'=> $item['phone'],
            'shirt_size'=> $item['size'],
            'vegetarian'=> $item['vegetarian']
        ];
        $rawUpdate = [
            'member_type'=> $item['member_type'],
            'name_title'=> $item['name_title'],
            'name'=> $item['name'],
            'surname'=> $item['surname'],
            'member_class'=> $item['member_class'],
            'phone'=> $item['phone'],
            'shirt_size'=> $item['size'],
            'vegetarian'=> $item['vegetarian']
        ];
        $imLastId = $MTMember->insertUpdateThis($rawInsert,$rawUpdate);
    }

    $_SESSION['action_status']='success';
    $_SESSION['action_message']='Confirm success.';
}
elseif($fn=='addConfirmTeacher'){
    $jsonTraining = $MMain->getInput('training');
    $it = json_decode($jsonTraining,true);

    $jsonMember = $MMain->getInput('member');
    $im = json_decode($jsonMember,true);

    $rawInsert = [
        'main_training_id'=> $it['main_training_id'],
        'project_id'=> $it['project_id'],
        'training_confirm'=> $it['training_confirm'],
        'training_status'=> 'WAIT',
        'training_state'=> $it['training_state'],
        'checkin_datetime'=> $it['checkin_datetime']
    ];
    $rawUpdate = [
        'training_confirm'=> $it['training_confirm'],
        'training_status'=> 'WAIT',
        'training_state'=> $it['training_state'],
        'checkin_datetime'=> $it['checkin_datetime']
    ];
    $lastId = $MTrain->insertUpdateThis($rawInsert,$rawUpdate);
    $result = $MTrain->selectThis(['main_training_id'=> $it['main_training_id'],'project_id'=> $it['project_id']]);
    if(isset($result['id'])){
        $lastId = $result['id'];
    }

    foreach ($im as $key=>$item){
        $rawInsert = [
            'training_id'=> $lastId,
            'user_id'=> $item['user_id'],
            'member_type'=> $item['member_type'],
            'name_title'=> $item['name_title'],
            'name'=> $item['name'],
            'surname'=> $item['surname'],
            'member_class'=> $item['member_class'],
            'phone'=> $item['phone'],
            'shirt_size'=> $item['size'],
            'vegetarian'=> $item['vegetarian']
        ];
        $rawUpdate = [
            'member_type'=> $item['member_type'],
            'name_title'=> $item['name_title'],
            'name'=> $item['name'],
            'surname'=> $item['surname'],
            'member_class'=> $item['member_class'],
            'phone'=> $item['phone'],
            'shirt_size'=> $item['size'],
            'vegetarian'=> $item['vegetarian']
        ];
        $imLastId = $MTMember->insertUpdateThis($rawInsert,$rawUpdate);
    }

    $_SESSION['action_status']='success';
    $_SESSION['action_message']='Confirm success.';
}
elseif($fn=='addConfirmStudent'){
    $jsonTraining = $MMain->getInput('training');
    $it = json_decode($jsonTraining,true);

    $jsonMember = $MMain->getInput('member');
    $im = json_decode($jsonMember,true);

    $rawInsert = [
        'main_training_id'=> $it['main_training_id'],
        'project_id'=> $it['project_id'],
        'training_confirm'=> $it['training_confirm'],
        'training_status'=> 'WAIT',
        'training_state'=> $it['training_state'],
        'checkin_datetime'=> $it['checkin_datetime']
    ];
    $rawUpdate = [
        'training_confirm'=> $it['training_confirm'],
        'training_status'=> 'WAIT',
        'training_state'=> $it['training_state'],
        'checkin_datetime'=> $it['checkin_datetime']
    ];
    $lastId = $MTrain->insertUpdateThis($rawInsert,$rawUpdate);
    $result = $MTrain->selectThis(['main_training_id'=> $it['main_training_id'],'project_id'=> $it['project_id']]);
    if(isset($result['id'])){
        $lastId = $result['id'];
    }

    foreach ($im as $key=>$item){
        $rawInsert = [
            'training_id'=> $lastId,
            'user_id'=> $item['user_id'],
            'member_type'=> $item['member_type'],
            'name_title'=> $item['name_title'],
            'name'=> $item['name'],
            'surname'=> $item['surname'],
            'member_class'=> $item['member_class'],
            'phone'=> $item['phone'],
            'shirt_size'=> $item['size'],
            'vegetarian'=> $item['vegetarian']
        ];
        $rawUpdate = [
            'member_type'=> $item['member_type'],
            'name_title'=> $item['name_title'],
            'name'=> $item['name'],
            'surname'=> $item['surname'],
            'member_class'=> $item['member_class'],
            'phone'=> $item['phone'],
            'shirt_size'=> $item['size'],
            'vegetarian'=> $item['vegetarian']
        ];
        $imLastId = $MTMember->insertUpdateThis($rawInsert,$rawUpdate);
    }

    $_SESSION['action_status']='success';
    $_SESSION['action_message']='Confirm success.';
}

$TEACHER = [];
$STUDENT = [];
$STATE = [];
$SHIRT_SIZE = [];
$T_UPDATE = true;

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


    //team pass
    if($this_t_group=='PASS'){

        //check user project
        $result = $MPMember->selectThis(['project_id'=>$this_pro_id,'user_id'=>$LOGIN_USER_ID]);
        if(isset($result['id'])){
            $result = $MPPhase->selectThis(['project_id'=>$this_pro_id,'sq'=>$this_t_sq]);
            if(isset($result['id'])){
                if($result['phase_status']!='PASS'){
                    header( "location: /upost.php" );
                    exit(0);
                }
            }
            else{
                header( "location: /upost.php" );
                exit(0);
            }
        }
        else{
            header( "location: /upost.php" );
            exit(0);
        }

        //student add teacher
        $STUDENT = [];
        $TEACHER = [];
        $result = $MPMember->selectThisAll(['project_id'=>$this_pro_id]);
        if(count($result)>0){
            foreach ($result as $key=>$item){
                if( strtoupper($item['member_type']) == 'STUDENT' ){
                    $STUDENT[] = ['user_id'=>$item['user_id']];
                }else{
                    $TEACHER[] = ['user_id'=>$item['user_id']];
                }
            }
        }

        //user
        foreach ($STUDENT as $key=>$item){
            $result = $MUser->selectThis(['id'=>$item['user_id']]);
            if(isset($result['id'])){
                $STUDENT[$key]['name_title'] = $result['name_title'];
                $STUDENT[$key]['name'] = $result['name'];
                $STUDENT[$key]['surname'] = $result['surname'];
                $STUDENT[$key]['phone'] = $result['phone'];
                //default
                $STUDENT[$key]['member_class'] = '';
                $STUDENT[$key]['shirt_size'] = '';
                $STUDENT[$key]['vegetarian'] = 'N';
            }
        }
        foreach ($TEACHER as $key=>$item){
            $result = $MUser->selectThis(['id'=>$item['user_id']]);
            if(isset($result['id'])){
                $TEACHER[$key]['name_title'] = $result['name_title'];
                $TEACHER[$key]['name'] = $result['name'];
                $TEACHER[$key]['surname'] = $result['surname'];
                $TEACHER[$key]['phone'] = $result['phone'];
                //default
                $TEACHER[$key]['member_class'] = '';
                $TEACHER[$key]['shirt_size'] = '';
                $TEACHER[$key]['vegetarian'] = 'N';
            }
        }

        //sol
        $this_t_id = 0;
        $result = $MTrain->selectThis(['main_training_id'=>$this_m_t_id,'project_id'=>$this_pro_id]);
        if(isset($result['id'])){
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
        if($this_t_id!=0){
            foreach ($STUDENT as $key=>$item){
                $result = $MTMember->selectThis(['user_id'=>$item['user_id'] , 'training_id'=>$this_t_id ]);

                if(isset($result['id'])){
                    $STUDENT[$key]['name_title'] = $result['name_title'];
                    $STUDENT[$key]['name'] = $result['name'];
                    $STUDENT[$key]['surname'] = $result['surname'];
                    $STUDENT[$key]['phone'] = $result['phone'];
                    $STUDENT[$key]['member_class'] = $result['member_class'];
                    $STUDENT[$key]['shirt_size'] = $result['shirt_size'];
                    $STUDENT[$key]['vegetarian'] = $result['vegetarian'];
                }
            }
            foreach ($TEACHER as $key=>$item){
                $result = $MTMember->selectThis(['user_id'=>$item['user_id'] ,'training_id'=>$this_t_id]);
                if(isset($result['id'])){
                    $TEACHER[$key]['name_title'] = $result['name_title'];
                    $TEACHER[$key]['name'] = $result['name'];
                    $TEACHER[$key]['surname'] = $result['surname'];
                    $TEACHER[$key]['phone'] = $result['phone'];
                    $TEACHER[$key]['member_class'] = $result['member_class'];
                    $TEACHER[$key]['shirt_size'] = $result['shirt_size'];
                    $TEACHER[$key]['vegetarian'] = $result['vegetarian'];
                }
            }
        }

    }

    //teacher not pass
    elseif ($this_t_group=='TEACHER'){

        //check teacher
        $result = $MUser->selectThis(['id'=>$LOGIN_USER_ID , 'role'=>'teacher']);
        if(!isset($result['id'])){
            header( "location: /upost.php" );
            exit(0);
        }

        //check not pass
        $sql = "SELECT pm.* FROM b2i_project_member pm 
        LEFT JOIN b2i_project p ON pm.project_id = p.id
        WHERE pm.user_id= ".$LOGIN_USER_ID." AND p.main_id = ".$this_m_pro_id;
        $result = $MMain->sqlAll($sql);
        if(count($result) > 0){
            $check = false;
            foreach ($result as $key=>$item){
                $r = $MPPhase->selectThis(['project_id'=>$item['project_id'],'sq'=>$this_t_sq,'phase_status'=>'PASS']);
                if(isset($r['id'])){
                    $check=true;
                    break;
                }
            }
            if($check){
                header( "location: /upost.php" );
                exit(0);
            }
        }

        //teacher
        $TEACHER = [];
        $TEACHER[] = ['user_id'=>$LOGIN_USER_ID];

        //user
        foreach ($TEACHER as $key=>$item){
            $result = $MUser->selectThis(['id'=>$item['user_id']]);
            if(isset($result['id'])){
                $TEACHER[$key]['name_title'] = $result['name_title'];
                $TEACHER[$key]['name'] = $result['name'];
                $TEACHER[$key]['surname'] = $result['surname'];
                $TEACHER[$key]['phone'] = $result['phone'];
                //default
                $TEACHER[$key]['member_class'] = '';
                $TEACHER[$key]['shirt_size'] = '';
                $TEACHER[$key]['vegetarian'] = 'N';
            }
        }
        //sol
        $this_t_id = 0;
        $result = $MTrain->selectThis(['main_training_id'=>$this_m_t_id,'project_id'=>$this_pro_id]);
        if(isset($result['id'])){
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
        if($this_t_id!=0){
            foreach ($TEACHER as $key=>$item){
                $result = $MTMember->selectThis(['user_id'=>$item['user_id'] ,'training_id'=>$this_t_id]);
                if(isset($result['id'])){
                    $TEACHER[$key]['name_title'] = $result['name_title'];
                    $TEACHER[$key]['name'] = $result['name'];
                    $TEACHER[$key]['surname'] = $result['surname'];
                    $TEACHER[$key]['phone'] = $result['phone'];
                    $TEACHER[$key]['member_class'] = $result['member_class'];
                    $TEACHER[$key]['shirt_size'] = $result['shirt_size'];
                    $TEACHER[$key]['vegetarian'] = $result['vegetarian'];
                }
            }
        }


    }




}



