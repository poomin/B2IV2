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



$TRAINING = [];

$result = $MMain->selectThis(['main_status'=>'Y']);
if(isset($result['id'])){
    $this_main_pro_id = $result['id'];
    $this_main_pro_name = $result['name'];

    $result = $MTrain->selectAllThis(['main_id'=>$this_main_pro_id]);
    if(count($result) > 0){
        $TRAINING = $result;
        foreach ($TRAINING as $key=>$item){
            $result = $MT->selectAllThis(['main_training_id'=>$item['id']]);
            $TRAINING[$key]['count'] = count($result);
        }
    }

}






