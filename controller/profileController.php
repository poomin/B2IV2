<?php
/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 4/2/2019
 * Time: 5:25 PM
 */
require_once __DIR__.'/../model/UserModel.php';
require_once __DIR__ . '/../model/SchoolModel.php';
$MUser = new UserModel();
$MSchool = new SchoolModel();

$SCHOOLS = [];


$this_user_id = isset($LOGIN_USER_ID)?$LOGIN_USER_ID:'';
$this_user_username = '';
$this_user_email = '';
$this_user_phone = '';
$this_user_name_title = '';
$this_user_name = '';
$this_user_surname = '';
$this_user_schoolname = '';
$this_user_schoolregion = '';
$this_user_role = '';

$this_user_image =isset($LOGIN_USER_IMAGE)?$LOGIN_USER_IMAGE:'/images/profile.png';

//------------------ function

$fn = $MUser->getInput('fn');
if($fn=='editUser'){

    $p_name_title = $MUser->getInput('name_title');
    $p_name = $MUser->getInput('name');
    $p_surname = $MUser->getInput('surname');
    $p_email = $MUser->getInput('email');
    $p_phone = $MUser->getInput('phone');
    $p_school_name = $MUser->getInput('school_name');
    $p_schoolregion = $MUser->getInput('schoolregion');

    $raw = [
        'email'=>$p_email,
        'phone'=>$p_phone,
        'name_title'=>$p_name_title,
        'name'=>$p_name,
        'surname'=>$p_surname,
        'schoolname'=>$p_school_name,
        'schoolregion'=>$p_schoolregion
    ];
    $condition = [
        'id'=>$this_user_id,
    ];

    $user_row = $MUser->editThis($raw,$condition);
    if($user_row >0){
        $_SESSION['action_status']='success';
        $_SESSION['action_message']='Edit user profile success.';

    }
    else{
        $_SESSION['action_status']='warning';
        $_SESSION['action_message']='Edit user profile fail!!!';
    }

}

elseif ($fn=='modalChangePassword'){
    $p_old = $MUser->getInput('pass');
    $p_new = $MUser->getInput('password');

    $raw = [
        'password'=> md5($p_new)
    ];
    $condition = [
        'id'=>$this_user_id,
        'password'=> md5($p_old)
    ];

    $user_row = $MUser->editThis($raw,$condition);

    if($user_row >0){
        $_SESSION['action_status']='success';
        $_SESSION['action_message']='Change password success.';

    }
    else{
        $_SESSION['action_status']='warning';
        $_SESSION['action_message']='Change password fail !!! <br>Check password input.';
    }

}



//>>>>>>>>>>> page

//school
$result = $MSchool->selectAllThis([]);
if(count($result)>0){
    $SCHOOLS = $result;
}

//user
$result = $MUser->selectThis(['id'=>$this_user_id]);
if($result){
    $this_user_name_title = $result['name_title'];
    $this_user_username = $result['username'];
    $this_user_email = $result['email'];
    $this_user_phone = $result['phone'];
    $this_user_name = $result['name'];
    $this_user_surname = $result['surname'];
    $this_user_schoolname = $result['schoolname'];
    $this_user_schoolregion = $result['schoolregion'];
    $this_user_role = $result['role'];
}



