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

$MMain = new MainProjectModel();
$MPhase = new MainPhaseModel();

$MPro = new ProjectModel();

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



    //phase
    $sql = 'where main_id='.$this_main_id.' order by sq ASC';
    $result = $MPhase->selectSqlAll($sql);
    if(count($result)>0){
        $TABLE_HEADER = $result;
    }
    $MAIN_PHASE_KEY = [];
    foreach ($TABLE_HEADER as $key=>$item){
        $MAIN_PHASE_KEY[$item['sq']] = $item;
    }


    //project
    $result = $MPro->selectAllByUid($this_user_id);
    if(count($result)>0){
        //set status phase [close , open , wait , fail , pass];
        $PROJECTS = $result;
        foreach ($PROJECTS as $key=>$item) {
            $phase_state = [];
            foreach ($MAIN_PHASE_KEY as $k=>$i){

                $i_status = 'close';



                $phase_state[] =  $i_status;
            }


            $PROJECTS[$key]['phase_state'] = $phase_state;
        }
    }






}