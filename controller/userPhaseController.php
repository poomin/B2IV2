<?php
/**
 * Created by PhpStorm.
 * User: PF0T4E5G
 * Date: 17/4/2562
 * Time: 02:55 หลังเที่ยง
 */
require_once __DIR__.'/../model/MainProjectModel.php';
require_once __DIR__.'/../model/MainPhaseModel.php';

require_once __DIR__.'/../model/ProjectModel.php';
require_once __DIR__.'/../model/ProjectPhaseModel.php';

$MMain = new MainProjectModel();
$MPhase = new MainPhaseModel();

$MPro = new ProjectModel();
$MProPhase = new ProjectPhaseModel();


//>>>>>>>>>>>>>> function
$fn = $MPro->getInput('fn');
if($fn=='modalDelete'){

    $user_id = $MPro->getInput('delete_id');

    $condition = [
        'id'=>$user_id
    ];

    $user_row = $MPro->deleteThis($condition);
    if($user_row >0){
        $_SESSION['action_status']='success';
        $_SESSION['action_message']='Delete user success.';
    }
    else{
        $_SESSION['action_status']='warning';
        $_SESSION['action_message']='Delete user fail!!!';
    }

}







$TABLE_HEADER = [];
$PROJECTS = [];
$this_user_id = $LOGIN_USER_ID;


$this_main_id = '';
$this_main_year = '';
$this_main_name = '';
$this_main_name_en = '';

$result = $MMain->selectThis(['main_status'=>'Y']);
if(isset($result['id'])){
    $this_main_id = $result['id'];
    $this_main_year = $result['main_year'];
    $this_main_name = $result['name'];
    $this_main_name_en = $result['name_en'];



    //phase setup
    $sql = 'where main_id='.$this_main_id.' order by sq ASC';
    $result = $MPhase->selectSqlAll($sql);
    if(count($result)>0){
        $TABLE_HEADER = $result;
    }
    $MAIN_PHASE_KEY = [];
    foreach ($TABLE_HEADER as $key=>$item){
        unset($item['detail']);
        $MAIN_PHASE_KEY[$item['sq']] = $item;
    }

    //project
    $result = $MPro->selectAllByUid($this_user_id);
    if(count($result)>0){
        //set status phase [close , open , wait , fail , pass];
        $PROJECTS = $result;
        foreach ($PROJECTS as $key=>$item) {

            //project phase
            $PHASE_KEY = [];
            $sql = 'where project_id='.$item['id'].' order by sq ASC';
            $result = $MProPhase->selectSqlAll($sql);
            foreach ($result as $k=>$i){
                $PHASE_KEY[$i['sq']] = $i;
            }

            $phase_state = [];
            $this_fail = false;
            foreach ($MAIN_PHASE_KEY as $k=>$i){

                $dateNow = strtotime(date('Y-m-d'));
                $dateStart = strtotime($i['date_start']);
                $dateEnd = strtotime($i['date_end']);

                if($dateNow < $dateStart) {
                    $i_status = 'close';
                }elseif($this_fail){
                    $i_status = 'close';
                }else{
                    if($dateStart <= $dateNow && $dateNow<= $dateEnd){
                        $i_status = 'open';
                        if(isset($PHASE_KEY[$i['sq']])){
                            if($PHASE_KEY[$i['sq']]['phase_status'] == 'FAIL'){
                                $i_status = 'fail';
                                $this_fail = true;
                            }elseif($PHASE_KEY[$i['sq']]['phase_status'] == 'PASS'){
                                $i_status = 'pass';
                            }
                        }

                    }else{
                        $i_status = 'wait';
                        if(isset($PHASE_KEY[$i['sq']])){
                            if($PHASE_KEY[$i['phase_status']] == 'FAIL'){
                                $i_status = 'fail';
                                $this_fail = true;
                            }elseif($PHASE_KEY[$i['phase_status']] == 'PASS'){
                                $i_status = 'pass';
                            }
                        }
                    }
                }

                $phase_state[] =  $i_status;
            }


            $PROJECTS[$key]['phase_state'] = $phase_state;
        }

    }


}