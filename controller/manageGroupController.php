<?php
/**
 * Created by PhpStorm.
 * User: PF0T4E5G
 * Date: 16/4/2562
 * Time: 02:20 ก่อนเที่ยง
 */

require_once __DIR__.'/../model/MainProjectModel.php';
require_once __DIR__.'/../model/MainGroupModel.php';
require_once __DIR__.'/../model/MainMapModel.php';
require_once __DIR__.'/../model/ProjectModel.php';


$MMain = new MainProjectModel();
$MGroup = new MainGroupModel();
$MMap = new MainMapModel();
$MPro = new ProjectModel();

$request_sq = $MMain->getInput('sq','0');

//---------------- function

$fn = $MMain->getInput('fn');
if($fn==='addMap'){
    $dataAll = $MMain->getInput('all');
    $dataActive = $MMain->getInput('active');

    $sq = $request_sq;

    if($dataAll!='-'){
        $cutAll = explode(":",$dataAll);
        foreach ($cutAll as $item){
            $cut = explode("-",$item);
            $result = $MMap->deleteThis(['project_id'=>$cut[0] , 'main_group_id'=>$cut[1],'sq'=>$sq]);
        }
    }
    if($dataActive!='-'){
        $cutAll = explode(":",$dataActive);
        foreach ($cutAll as $item){
            $cut = explode("-",$item);
            $result = $MMap->insertThis(['project_id'=>$cut[0] , 'main_group_id'=>$cut[1],'sq'=>$sq]);
        }
    }

    $_SESSION['action_status']='success';
    $_SESSION['action_message']='Mapping success.';

}


//================ sol function
function solGroupId($arrMapAll , $attrProjectId){
    $dataReturn = [];
    foreach ($arrMapAll as $key=>$item){
        if($item['project_id']==$attrProjectId){
            $dataReturn[] = $item['main_group_id'];
        }
    }
    return $dataReturn;
}

//================= page

$GROUPS = [];
$PROJECT = [];
$MAP = [];

$this_main_id = '';
$this_main_year = '';
$this_main_name = '';
$this_main_name_en = '';

$this_sq = '';


$result = $MMain->selectThis(['main_status'=>'Y']);
if(isset($result['id'])){
    $this_main_id = $result['id'];
    $this_main_year = $result['main_year'];
    $this_main_name = $result['name'];
    $this_main_name_en = $result['name_en'];
    $this_sq = $request_sq;

    //map
    $result = $MMap->selectThisAll(['sq'=>$this_sq]);
    if(count($result)>0){
        $MAP = $result;
    }

    //group
    $result = $MGroup->selectThisAll(['main_id'=>$this_main_id,'sq'=>$this_sq]);
    if(count($result) > 0){
        $GROUPS = $result;
    }


    //if sq == 1 all
    if($this_sq == 1){
        $result = $MPro->selectThisAll(['main_id'=>$this_main_id]);
        if(count($result)>0){
            $PROJECT = $result;
        }
    }else{
        $sql = 'SELECT * FROM b2i_project_phase AS ph
LEFT JOIN b2i_project AS pro ON pro.id = ph.project_id
WHERE pro.main_id= '.$this_main_id.' AND ph.sq= '.($this_sq);
        $result = $MMain->sqlAll($sql);
        if(count($result)>0){
            $PROJECT = $result;
        }
    }
    foreach ($PROJECT as $key=>$item){
        $PROJECT[$key]['map'] = solGroupId($MAP,$item['id']);
    }

}

//echo json_encode($PROJECT);exit;