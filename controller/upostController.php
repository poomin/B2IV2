<?php

require_once __DIR__.'/../model/MainProjectModel.php';
require_once __DIR__.'/../model/MainTrainingModel.php';

require_once __DIR__.'/../model/TrainingModel.php';
require_once __DIR__.'/../model/ProjectPhaseModel.php';
require_once __DIR__.'/../model/UserModel.php';


$MMain = new MainProjectModel();
$MTrain = new MainTrainingModel();

$MTrain = new TrainingModel();

$MPPhase = new ProjectPhaseModel();
$MUser = new UserModel();

$LOGIN_USER_ID = isset($LOGIN_USER_ID)?$LOGIN_USER_ID:0;


$TRAINING = [];

$result = $MMain->selectThis(['main_status'=>'Y']);
if($LOGIN_USER_ID!= 0 && isset($result['id']) ){

    $main_pro_id = $result['id'];

    $this_ymd= date('Y-m-d');
    $sql = "SELECT * FROM b2i_main_training AS mt WHERE mt.main_id= ".$main_pro_id." AND '".$this_ymd."' BETWEEN mt.date_start AND mt.date_end";
    $result = $MMain->sqlAll($sql);
    $arrTrain = [];
    if(count($result)>0){

        $arrTrain = $result;

        //PASS
        foreach ($arrTrain as $key=>$item){
            if($item['training_group'] == 'PASS'){
                $i_t_sq = $item['sq'];
                $i_t_id = $item['id'];
                //project join member
                $sql = 'SELECT p.name , p.id  FROM b2i_project_member AS pm LEFT JOIN b2i_project AS p ON pm.project_id = p.id WHERE pm.user_id = '.$LOGIN_USER_ID.' AND p.main_id = '.$main_pro_id;
                $result = $MMain->sqlAll($sql);
                $pjm = [];
                if(count($result)>0){
                    $pjm = $result;
                    foreach ($pjm as $k=>$i){
                        //check phase pass
                        $result = $MPPhase->selectThis(['project_id'=>$i['id'],'sq'=>$i_t_sq,'phase_status'=>'PASS']);
                        if(isset($result['id'])){

                            $i_training_status = "NON";
                            $resultTraining = $MTrain->selectThis(['main_training_id'=>$i_t_id,'project_id'=>$i['id']]);
                            if(isset($resultTraining['training_status'])){
                                $i_training_status = $resultTraining['training_status'];
                            }

                            $TRAINING[] = [
                                'project_id'=>$i['id'],
                                'project_name'=>$i['name'],
                                'training_id'=>$item['id'],
                                'training_title'=>$item['training_title'],
                                'confirm'=>$i_training_status
                            ];
                        }//end if check pass
                    }//end for pjm
                }//end if count pjm null
            }//end if training pass
        }//endfor

        //TEACHER
        if(count($TRAINING)<=0){
            foreach ($arrTrain as $key=>$item){
                if($item['training_group'] == 'TEACHER'){
                    $result = $MUser->selectThis(['id'=>$LOGIN_USER_ID , 'role'=>'teacher']);
                    $convertProIdByUserId = 1000000000+ intval($LOGIN_USER_ID);
                    if(isset($result['id'])){
                        $i_t_id = $item['id'];
                        $i_training_status = "NON";
                        $resultTraining = $MTrain->selectThis(['main_training_id'=>$i_t_id,'project_id'=>$convertProIdByUserId]);
                        if(isset($resultTraining['training_status'])){
                            $i_training_status = $resultTraining['training_status'];
                        }

                        $TRAINING[] = [
                            'project_id'=>$convertProIdByUserId,
                            'project_name'=>"Project Not Pass",
                            'training_id'=>$item['id'],
                            'training_title'=>$item['training_title'],
                            'confirm'=>$i_training_status
                        ];
                    }

                }//end if training TEACHER
            }//endfor
        }

        //STUDENT
        if(count($TRAINING)<=0){
            foreach ($arrTrain as $key=>$item){
                if($item['training_group'] == 'STUDENT'){
                    $convertProIdByUserId = 1000000000+ intval($LOGIN_USER_ID);
                    $result = $MUser->selectThis(['id'=>$LOGIN_USER_ID , 'role'=>'student']);
                    if(isset($result['id'])){

                        $i_t_id = $item['id'];
                        $i_training_status = "NON";
                        $resultTraining = $MTrain->selectThis(['main_training_id'=>$i_t_id,'project_id'=>$convertProIdByUserId]);
                        if(isset($resultTraining['training_status'])){
                            $i_training_status = $resultTraining['training_status'];
                        }

                        $TRAINING[] = [
                            'project_id'=>$convertProIdByUserId,
                            'project_name'=>"Project Not Pass",
                            'training_id'=>$item['id'],
                            'training_title'=>$item['training_title'],
                            'confirm'=>$i_training_status
                        ];
                    }

                }//end if training STUDENT
            }//endfor
        }

        //ALL
        if(count($TRAINING)<=0){
            foreach ($arrTrain as $key=>$item){
                if($item['training_group'] == 'ALL'){
                    $TRAINING[] = [
                        'project_id'=>0,
                        'project_name'=>"Project Not Pass",
                        'training_id'=>$item['id'],
                        'training_title'=>$item['training_title'],
                        'confirm'=>'F'
                    ];

                }//end if training ALL
            }//endfor
        }

    }

    foreach ($TRAINING as $key => $item){
        $sql = 'SELECT t.training_confirm FROM b2i_training_member AS tm  LEFT JOIN b2i_training AS t ON tm.training_id = t.id WHERE tm.user_id = '.$LOGIN_USER_ID.' AND t.id = '.$item['training_id'];
        $result = $MMain->sqlAll($sql);
        if(count($result)>0){
            $TRAINING[$key]['confirm'] = $result[0]['training_confirm'];
        }
    }

}