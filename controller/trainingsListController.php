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
$this_main_t_group = '';

$result = $MTrain->selectThis(['id'=>$this_main_t_id]);
if(isset($result['id'])){
    $this_main_t_group = $result['training_group'];


    if($this_main_t_group=='PASS'){
        $sql = "SELECT t.* , p.name , p.project_school as school , p.project_region as region FROM b2i_training t
                LEFT JOIN b2i_project p ON t.project_id = p.id
                WHERE t.main_training_id = ".$this_main_t_id;
        $result = $MMain->sqlAll($sql);
        if(isset($result) && count($result)>0){
            $TRAINING = $result;
        }
    }
    else{
        $sql= 'SELECT t.* , CONCAT(u.name_title, " " , u.name , " " ,u.surname) AS name , u.schoolname AS school , u.schoolregion AS region FROM b2i_training t
                LEFT JOIN b2i_user u ON t.project_id = (u.id + 1000000000 )
                WHERE t.main_training_id = '.$this_main_t_id;
        $result = $MMain->sqlAll($sql);
        if(isset($result) && count($result)>0){
            $TRAINING = $result;
        }

    }

}
else{
    header( "location: /ltrainings.php" );
    exit(0);
}






