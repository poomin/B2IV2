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
$this_user_name = '';
$this_user_surname = '';
$this_user_schoolname = '';
$this_user_schoolregion = '';
$this_user_role = '';
$this_user_image =isset($LOGIN_USER_IMAGE)?$LOGIN_USER_IMAGE:'/images/profile.png';







//>>>>>>>>>>> page

//school
$result = $MSchool->selectAllThis([]);
if(count($result)>0){
    $SCHOOLS = $result;
}

//user
$result = $MUser->selectThis(['id'=>$this_user_id]);
if($result){
    $this_user_username = $result['username'];
    $this_user_email = $result['email'];
    $this_user_name = $result['name'];
    $this_user_surname = $result['surname'];
    $this_user_schoolname = $result['schoolname'];
    $this_user_schoolregion = $result['schoolregion'];
    $this_user_role = $result['role'];
}



