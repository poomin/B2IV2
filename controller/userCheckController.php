<?php
/**
 * Created by PhpStorm.
 * User: PF0T4E5G
 * Date: 17/4/2562
 * Time: 02:55 หลังเที่ยง
 */
require_once __DIR__.'/../model/MainProjectModel.php';
require_once __DIR__.'/../model/MainPhaseModel.php';

require_once __DIR__.'/../model/UserModel.php';
require_once __DIR__.'/../model/SchoolModel.php';

require_once __DIR__.'/../model/ProjectModel.php';
require_once __DIR__.'/../model/ProjectPhaseModel.php';

$MMain = new MainProjectModel();
$MPhase = new MainPhaseModel();

$MUser = new UserModel();
$MSchool = new SchoolModel();

$MPro = new ProjectModel();
$MProPhase = new ProjectPhaseModel();


$TABLE_HEADER = [];
$PROJECTS = [];
$this_user_id = $LOGIN_USER_ID;


$this_main_id = '';
$this_main_year = '';
$this_main_name = '';
$this_main_name_en = '';


$this_school_name = '';
$this_province = '';
$this_address = '';
$this_sub = '';
$this_district = '';
$this_code = '';


$result = $MMain->selectThis(['main_status'=>'Y']);
if(isset($result['id'])){
    $this_main_id = $result['id'];
    $this_main_year = $result['main_year'];
    $this_main_name = $result['name'];
    $this_main_name_en = $result['name_en'];


    $result = $MUser->selectThis(['id'=>$this_user_id]);

    if(isset($result['schoolname'])){
        $this_school_name = $result['schoolname'];

        $result = $MSchool->selectThis(['school_name'=>$this_school_name]);
        if(isset($result['school_name'])){
            $this_province = $result['province'];
            $this_address = $result['address'];
            $this_sub = $result['subdistrict'];
            $this_district = $result['district'];
            $this_code = $result['code'];
        }
    }


    //project
    $result = $MPro->selectThisAll(['project_school'=>$this_school_name]);
    if(count($result)>0){
        //set status phase [close , open , wait , fail , pass];
        $PROJECTS = $result;
        foreach ($PROJECTS as $key=>$item) {

            $sql = 'SELECT u.* FROM b2i_user AS u LEFT JOIN b2i_project_member AS m ON m.user_id = u.id WHERE m.member_type = "ADVISER" AND m.project_id='.$item['id'];
            $result = $MMain->sqlAll($sql);

            if(count($result)>0){
                $PROJECTS[$key]['ADVISER'] = $result[0]['name'].' '.$result[0]['surname'];
            }else{
                $PROJECTS[$key]['ADVISER'] = '';
            }
        }

    }

}