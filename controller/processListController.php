<?php
/**
 * Created by PhpStorm.
 * User: PF0T4E5G
 * Date: 19/4/2562
 * Time: 01:15 ก่อนเที่ยง
 */

require_once __DIR__.'/../model/MainProjectModel.php';
require_once __DIR__.'/../model/MainPhaseModel.php';
require_once __DIR__.'/../model/ProjectModel.php';

$MMain = new MainProjectModel();
$MMPhase = new MainPhaseModel();
$MPro = new ProjectModel();
$this_s = $MMain->getInput('s','all');

$this_main_id = $MMain->getInput('mid','0');
$this_main_year = '';
$this_main_name = '';
$this_main_name_en = '';

$this_phase_sq = $MMain->getInput('sq','1');
$this_phase_title = '';
$this_phase_text = '';
if(strtoupper($this_s)=='PASS'){
    $this_phase_text = '(ทีมที่ผ่านการคัดเลือก)';
}elseif (strtoupper($this_s)=='FAIL'){
    $this_phase_text = '(ทีมที่ไม่ผ่านการคัดเลือก)';
}

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

    $sql= 'select pro.* , phase.phase_status from b2i_project as pro left join b2i_project_phase as phase on pro.id = phase.project_id where pro.main_id = '.$this_main_id;
    if($this_phase_sq == 1){
        $sql = $sql. ' and ( phase.sq = '.$this_phase_sq . ' or phase.sq IS NULL )';
    }else{
        $sql = $sql. ' and phase.sq = '.$this_phase_sq;
    }

    if(strtoupper($this_s)=='PASS'){
        $sql = $sql.' AND phase.phase_status="PASS" ';
    }elseif (strtoupper($this_s)=='FAIL'){
        $sql = $sql.' AND phase.phase_status="FAIL" ';
    }

    $result = $MMain->sqlAll($sql);
    if (count($result)>0){
        $PROJECTS = $result;
    }
}else{
    header( "location: /lprocess.php" );
    exit(0);
}