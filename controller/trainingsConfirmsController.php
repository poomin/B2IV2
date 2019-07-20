<?php
/**
 * Created by PhpStorm.
 * User: PF0T4E5G
 * Date: 15/4/2562
 * Time: 12:09 ก่อนเที่ยง
 */
require_once __DIR__.'/../model/MainProjectModel.php';
require_once __DIR__.'/../model/MainTrainingModel.php';
require_once __DIR__.'/../model/TrainingModel.php';

$MMain = new MainProjectModel();
$MTrain = new MainTrainingModel();
$MT = new TrainingModel();


$this_main_t_id = $MMain->getInput('tid',0);
$TRAINING = [];

$result = $MTrain->selectThis(['id'=>$this_main_t_id]);
if(isset($result['id'])){
    $this_main_t_group = $result['training_group'];
    $this_main_t_sq = $result['sq'];
    $this_main_t_main_id = $result['main_id'];
    if($this_main_t_group=='PASS'){
        $sql = 'SELECT p.id, p.name , p.project_school , p.project_region FROM b2i_project AS p
LEFT JOIN b2i_project_phase AS ph ON p.id = ph.project_id
LEFT JOIN b2i_training AS t ON t.project_id = p.id
WHERE p.main_id = '.$this_main_t_main_id.' AND ph.sq= '.$this_main_t_sq.' AND ph.phase_status = "PASS" AND t.id IS NULL';
        $result = $MMain->sqlAll($sql);
        if(isset($result) && count($result)>0){
            $TRAINING = $result;
        }
    }

}






