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
            if($item['training_group']=='PASS'){
                $result = $MT->selectAllThis(['main_training_id'=>$item['id']]);
                $i_confirm = count($result);
                $sq ='SELECT pp.id FROM b2i_project AS p LEFT JOIN b2i_project_phase AS pp ON p.id = pp.project_id 
WHERE pp.phase_status = "PASS" AND p.main_id = '.$this_main_pro_id.' AND pp.sq='.$item['sq'];
                $result = $MMain->sqlAll($sq);
                $i_all = count($result);
                $TRAINING[$key]['confirm'] = $i_confirm;
                $TRAINING[$key]['wait'] = ($i_all - $i_confirm);
            }else{
                $result = $MT->selectAllThis(['main_training_id'=>$item['id']]);
                $i_all = count($result);
                $result = $MT->selectAllThis(['main_training_id'=>$item['id'],'training_status'=>'PASS','training_confirm'=>'Y']);
                $i_confirm = count($result);
                $TRAINING[$key]['confirm'] = $i_confirm;
                $TRAINING[$key]['wait'] = ($i_all - $i_confirm);

            }//end if
        }//end for
    }//end if

//    echo json_encode($TRAINING,true);exit;
}






