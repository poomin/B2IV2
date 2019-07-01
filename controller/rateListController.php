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
require_once __DIR__.'/../model/ProjectModel.php';
require_once __DIR__.'/../model/ProjectPhaseModel.php';

$MMain = new MainProjectModel();
$MMPhase = new MainPhaseModel();
$MBoard = new MainBoardModel();

$MPro = new ProjectModel();
$MPPhase = new ProjectPhaseModel();

$this_main_id = $MMain->getInput('mid','0');
$this_main_year = '';
$this_main_name = '';
$this_main_name_en = '';

$this_phase_sq = $MMain->getInput('sq','1');
$this_phase_title = '';
$this_phase_text = '';

$PROJECTS = [];

$result = $MMain->selectThis(['id'=>$this_main_id]);
if(isset($result['id'])) {
    $this_main_id = $result['id'];
    $this_main_year = $result['main_year'];
    $this_main_name = $result['name'];
    $this_main_name_en = $result['name_en'];

    $result = $MMPhase->selectThis(['main_id'=>$this_main_id,'sq'=>$this_phase_sq]);
    if(isset($result['id'])){
        $this_phase_title = $result['title'];
    }

    $result = $MPro->selectThisAll(['main_id'=>$this_main_id]);
    if (count($result)>0){
        $PROJECTS = $result;
    }

    $KEY_SCORE = [];
    $sql = 'SELECT ps.project_id , SUM(ps.score) AS sum_score FROM b2i_project_score AS ps 
LEFT JOIN b2i_main_score AS ms ON ps.main_score_id = ms.id
WHERE ms.sq = '.$this_phase_sq.' AND ms.main_id = '.$this_main_id.' GROUP BY ps.project_id';
    $result = $MMain->sqlAll($sql);
    if(count($result) > 0){
        foreach ($result as $key=>$item){
            $KEY_SCORE[$item['project_id']] = $item['sum_score'];
        }
    }

    $Key_PHASE = [];
    $result = $MPPhase->selectThisAll(['sq'=>$this_phase_sq]);
    if(count($result) >0){
        foreach ($result as $key=>$item){
            $Key_PHASE[$item['project_id']] =$item;
        }
    }

    foreach ($PROJECTS as $key=>$item){

        //score
        if (isset($KEY_SCORE[$item['id']])){
            $PROJECTS[$key]['score'] = floatval($KEY_SCORE[$item['id']]);
        }else{
            $PROJECTS[$key]['score'] = '-';
        }

        //phase
        if (isset( $Key_PHASE[$item['id']]['phase_status'] ) ){
            $PROJECTS[$key]['phase_status'] = $Key_PHASE[$item['id']]['phase_status'];
        }else{
            $PROJECTS[$key]['phase_status'] = 'NON';
        }

    }




}else{
    header( "location: /lscore.php" );
    exit(0);
}