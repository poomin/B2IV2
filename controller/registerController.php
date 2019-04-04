<?php
/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 4/2/2019
 * Time: 11:06 AM
 */
require_once __DIR__ . '/../model/SchoolModel.php';
require_once __DIR__ . '/../model/UserModel.php';

$MUser = new UserModel();
$MSchool = new SchoolModel();

$SCHOOLS = [];


$fn = $MUser->getInput('fn');

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

//---- add user
elseif ($fn== 'insertUser'){
    $p_username = $MUser->getInput('username');
    $p_password = $MUser->getInput('password');
    $p_email = $MUser->getInput('email');
    $p_name = $MUser->getInput('name');
    $p_surname = $MUser->getInput('surname');
    $p_schoolname = $MUser->getInput('school_name');
    $p_schoolregion = $MUser->getInput('schoolregion');
    $p_role = $MUser->getInput('role');

    $raw = [
        'username'=>$p_username,
        'password'=> md5($p_password),
        'email'=>$p_email,
        'name'=>$p_name,
        'surname'=>$p_surname,
        'schoolname'=>$p_schoolname,
        'schoolregion'=>$p_schoolregion,
        'role'=>$p_role
    ];

    $user_id = $MUser->insertThis($raw);
    if(intval($user_id) > 0){
        $_SESSION['action_status']='success';
        $_SESSION['action_message']='Register success. Your can login by username and password.';
        header( "location: /index-login.php" );
        exit(0);
    }else{
        $_SESSION['action_status']='warning';
        $_SESSION['action_message']='Check data register! Data input or username duplicate.';
    }

}


//>>>>>>>>>>>>>>> in page

//school
$result = $MSchool->selectAllThis([]);
if(count($result)>0){
    $SCHOOLS = $result;
}











