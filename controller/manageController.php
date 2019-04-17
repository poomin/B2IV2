<?php
/**
 * Created by PhpStorm.
 * User: PF0T4E5G
 * Date: 16/4/2562
 * Time: 02:20 ก่อนเที่ยง
 */
require_once __DIR__.'/../model/MainProjectModel.php';
require_once __DIR__.'/../model/MainPhaseModel.php';
require_once __DIR__.'/../model/MainBoardModel.php';
require_once __DIR__.'/../model/MainScoreModel.php';

$MMain = new MainProjectModel();
$MPhase = new MainPhaseModel();
$MBoard = new MainBoardModel();
$MScore = new MainScoreModel();

$PHASE = [];


$fn = $MPhase->getInput('fn');
if($fn=='modalDelete'){

    $delete_id = $MPhase->getInput('delete_id');

    $condition = [
        'id'=>$delete_id
    ];


    $delete_rows = $MPhase->deleteThis($condition);
    if($delete_rows >0){
        $_SESSION['action_status']='success';
        $_SESSION['action_message']='Delete success.';

    }
    else{
        $_SESSION['action_status']='warning';
        $_SESSION['action_message']='Delete fail!!!';
    }

}



$this_main_id= '';
$this_main_year = '';
$this_main_name = '';
$this_main_name_en = '';
$result = $MMain->selectThis(['main_status'=>'Y']);
if(isset($result['id'])){
    $this_main_id = $result['id'];
    $this_main_year = $result['main_year'];
    $this_main_name = $result['name'];
    $this_main_name_en = $result['name_en'];

    $result = $MPhase->selectThisAll(['main_id'=>$this_main_id]);
    if(count($result)>0){
        $PHASE = $result;
    }

    foreach ($PHASE as $key=>$item){
        $PHASE[$key]['c_board'] = count($MBoard->selectThisAll(['main_id'=>$item['main_id'],'sq'=>$item['sq']]));
        $PHASE[$key]['c_score'] = count($MScore->selectThisAll(['main_id'=>$item['main_id'],'sq'=>$item['sq']]));
    }


}