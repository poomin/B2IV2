<?php
/**
 * Created by PhpStorm.
 * User: PF0T4E5G
 * Date: 17/4/2562
 * Time: 06:23 ก่อนเที่ยง
 */
require_once __DIR__.'/../model/ProjectModel.php';
require_once __DIR__.'/../model/MainProjectModel.php';

$MPro = new ProjectModel();
$MMain = new MainProjectModel();//

$this_main_name = '';  //MMain
$this_main_year = '';
$this_main_name_en = '';

$this_pro_name = '';
$this_pro_name_en = '';
$this_school = '';
$this_region = '';

//teacher
$this_name_title = '';
$this_name = '';
$this_surname = '';
//student
$MEMBERS = [];



$PID = $MPro->getInput('pid',0);
$result = $MPro->selectThis(['id'=>$PID]);
if(isset($result['id'])){
    $this_main_id = $result['main_id'];
    $this_region = $result['project_region'];
    $this_pro_name = $result['name'];
    $this_pro_name_en = $result['name_en'];
    $this_school = $result['project_school'];

    //main project
    $result = $MMain->selectThis(['id'=>$this_main_id]);
    if(isset($result['id'])){
        $this_main_name = $result['name'];
        $this_main_year = $result['main_year'];
        $this_main_name_en = $result['name_en'];
    }

    //select member in project
    $sql = 'SELECT pm.user_id , pm.member_type , u.name_title , u.name , u.surname , u.schoolname FROM b2i_project_member as pm
    LEFT JOIN b2i_user u ON u.id = pm.user_id
    WHERE pm.project_id = '.$PID;
    $result = $MMain->sqlAll($sql);
    if(count($result)>0){
        foreach ($result as $key => $item){
            if($item['member_type']=='ADVISER'){
                $this_name_title = $item['name_title'];
                $this_name = $item['name'];
                $this_surname = $item['surname'];
            }else{
                $MEMBERS[] = $item;
            }
        }
    }

}
else{
    header( "location: /lprocess-list.php" );
    exit(0);
}


