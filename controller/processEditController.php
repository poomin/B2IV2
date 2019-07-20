<?php
/**
 * Created by PhpStorm.
 * User: PF0T4E5G
 * Date: 17/4/2562
 * Time: 06:23 ก่อนเที่ยง
 */
require_once __DIR__.'/../model/ProjectModel.php';
require_once __DIR__.'/../model/ProjectMemberModel.php';
require_once __DIR__.'/../model/MainProjectModel.php';
require_once __DIR__.'/../model/MainPhaseModel.php';
require_once __DIR__ . '/../model/SchoolModel.php';
require_once __DIR__ . '/../model/UserModel.php';

$MPro = new ProjectModel();
$MMember = new ProjectMemberModel();
$MUser = new UserModel();
$MSchool = new SchoolModel();
$MMain = new MainProjectModel();
$MPhase = new MainPhaseModel();

$SCHOOLS = [];
$STUDENTS = [];
$MEMBERS = [];
$EDIT = false;
$PHASE_EDIT = false;
$DISABLE = $LOGIN_USER_ROLE=='teacher'?'':'disabled';

$this_user_id = $LOGIN_USER_ID;
$this_school = '';
$this_name_title = '';
$this_name = '';
$this_surname = '';
$this_region = '';

$this_main_id = '';
$this_main_year = '';
$this_main_name = '';
$this_main_name_en = '';

$this_pro_id = '';
$this_pro_name = '';
$this_pro_name_en = '';

//===================== function ======================

$fn = $MMain->getInput('fn');
if($fn=='editProject'){
    $p_project_id = $MPro->getInput('pro_id');

    $p_main_id = $MPro->getInput('main_id');
    $p_name = $MPro->getInput('name');
    $p_name_en = $MPro->getInput('name_en');
    $p_school = $MPro->getInput('school_name');
    $p_region = $MPro->getInput('region');
    $p_project_status = 'NON';

    $p_student_list = $MPro->getInput('studentList');

    $p_check = false;

    $raw = [
        'main_id'=>$p_main_id,
        'name'=>$p_name,
        'name_en'=>$p_name_en,
        'project_status'=>$p_project_status,
        'project_school'=>$p_school,
        'project_region'=>$p_region,
    ];
    //update project
    $update_rows = $MPro->editThis($raw,['id'=>$p_project_id]);
    if($update_rows>0) {
        $p_check = true;
    }

    //update member
    $result = $MMember->deleteThis(['project_id'=>$p_project_id , 'member_type'=>'STUDENT']);
    if($p_student_list!=''){
        $p_check = true;
        $cut = explode('-',$p_student_list);
        foreach ($cut as $item){
            $i_user_id = $item;
            $raw = [
                'project_id'=>$p_project_id,
                'user_id'=>$i_user_id,
                'member_type'=>'STUDENT'
            ];
            $result = $MMember->insertThis($raw);
        }
    }

    if($p_check){
        $_SESSION['action_status']='success';
        $_SESSION['action_message']='Edit Project success.';
    }else{
        $_SESSION['action_status']='warning';
        $_SESSION['action_message']='Edit Project fail!!!';
    }

}


//===================== page view data ======================
$PID = $MMember->getInput('pid','0');
//select project
$result = $MPro->selectThis(['id'=>$PID]);
if(isset($result['id'])){
    $this_main_id = $result['main_id'];
    $this_school = $result['project_school'];
    $this_region = $result['project_region'];
    $this_pro_name = $result['name'];
    $this_pro_name_en = $result['name_en'];

    //set main project
    $result = $MMain->selectThis(['id'=>$this_main_id]);
    if(isset($result['id'])) {
        $this_main_id = $result['id'];
        $this_main_year = $result['main_year'];
        $this_main_name = $result['name'];
        $this_main_name_en = $result['name_en'];
    }

    //school
    $result = $MSchool->selectAllThis([]);
    if(count($result)>0){
        $SCHOOLS = $result;
    }

    //select student in school
    $result = $MUser->selectThisAll(['role'=>'student','schoolname'=>$this_school]);
    if(count($result)>0){
        $STUDENTS = $result;
    }

    //select member student and teacher
    $result = $MMember->selectAllByProId($PID);
    foreach ($result as $key=>$item){
        if($item['member_type']=='ADVISER'){
            $this_name_title = $item['name_title'];
            $this_name = $item['name'];
            $this_surname = $item['surname'];
        }else{
            $MEMBERS[] = $item;
        }
    }

}
else{
    header( "location: /lprocess-list.php" );
    exit(0);
}




