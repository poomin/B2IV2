<?php
/**
 * Created by PhpStorm.
 * User: PF0T4E5G
 * Date: 7/4/2562
 * Time: 11:33 หลังเที่ยง
 */
require_once __DIR__ . '/../model/SchoolModel.php';

$MSchool = new SchoolModel();

$SCHOOLS = [];


$fn = $MSchool->getInput('fn');
//---- add school
if ($fn == 'insertSchool') {
    $p_school_name = $MSchool->getInput('name');
    $p_address = $MSchool->getInput('address');
    $p_subdistrict = $MSchool->getInput('subdistrict');
    $p_district = $MSchool->getInput('district');
    $p_province = $MSchool->getInput('province');
    $p_code = $MSchool->getInput('code');

    $raw = [
        'school_name' => $p_school_name,
        'address' => $p_address,
        'subdistrict' => $p_subdistrict,
        'district' => $p_district,
        'province' => $p_province,
        'code' => $p_code
    ];

    $school_id = $MSchool->insertThis($raw);

    if(intval($school_id) > 0){
        $_SESSION['action_status']='success';
        $_SESSION['action_message']='Add school success.';
    }else{
        $_SESSION['action_status']='warning';
        $_SESSION['action_message']='Check data school or name school duplicate.';
    }


}

elseif($fn=='modalDelete'){

    $school_id = $MSchool->getInput('delete_id');

    $condition = [
        'id'=>$school_id
    ];


    $school_row = $MSchool->deleteThis($condition);
    if($school_row >0){
        $_SESSION['action_status']='success';
        $_SESSION['action_message']='Delete school success.';

    }
    else{
        $_SESSION['action_status']='warning';
        $_SESSION['action_message']='Delete school fail!!!';
    }

}

elseif($fn == 'updateSchool') {
    $p_school_id = $MSchool->getInput('schoolId');
    $p_school_name = $MSchool->getInput('name');
    $p_address = $MSchool->getInput('address');
    $p_subdistrict = $MSchool->getInput('subdistrict');
    $p_district = $MSchool->getInput('district');
    $p_province = $MSchool->getInput('province');
    $p_code = $MSchool->getInput('code');

    $raw = [
        'school_name' => $p_school_name,
        'address' => $p_address,
        'subdistrict' => $p_subdistrict,
        'district' => $p_district,
        'province' => $p_province,
        'code' => $p_code
    ];
    $condition = [
        'id'=>$p_school_id
    ];

    $school_row = $MSchool->editThis($raw,$condition);

    if($school_row > 0){
        $_SESSION['action_status']='success';
        $_SESSION['action_message']='Edit school success.';
    }else{
        $_SESSION['action_status']='warning';
        $_SESSION['action_message']='Check data school or name school duplicate.';
    }


}


//>>>>>>>>>>>>>>> in page

//school
$result = $MSchool->selectAllThis([]);
if(count($result)>0){
    $SCHOOLS = $result;
}