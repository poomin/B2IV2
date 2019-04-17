<?php
/**
 * Created by PhpStorm.
 * User: PF0T4E5G
 * Date: 7/4/2562
 * Time: 04:57 ก่อนเที่ยง
 */

require_once __DIR__.'/../model/UserModel.php';
require_once __DIR__ . '/../model/SchoolModel.php';
$MUser = new UserModel();
$MSchool = new SchoolModel();

$SCHOOLS = [];
$this_user_id = $MUser->getInput('uid','');

//check user null
if($this_user_id==''){
    header( "location: /luser.php" );
    exit(0);
}




$this_user_username = '';
$this_user_email = '';
$this_user_name_title = '';
$this_user_name = '';
$this_user_surname = '';
$this_user_schoolname = '';
$this_user_schoolregion = '';
$this_user_role = '';
$this_user_image = '/images/profile.png';


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
    $this_user_name_title = $result['name_title'];
    $this_user_name = $result['name'];
    $this_user_surname = $result['surname'];
    $this_user_schoolname = $result['schoolname'];
    $this_user_schoolregion = $result['schoolregion'];
    $this_user_role = $result['role'];
    $this_user_image = $result['image_path'];
}

