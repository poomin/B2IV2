<?php
/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 4/2/2019
 * Time: 12:13 PM
 */
$LOGIN_USER_ID = '';
$LOGIN_USER_USERNAME = '';
$LOGIN_USER_ROLE = '';
$LOGIN_USER_IMAGE = '/images/profile.png';
if(isset($_SESSION['USER_ID'])){
    $LOGIN_USER_ID = $_SESSION['USER_ID'];
    $LOGIN_USER_USERNAME = $_SESSION['USER_USERNAME'];
    $LOGIN_USER_ROLE = $_SESSION['USER_ROLE'];
    $LOGIN_USER_IMAGE = isset($_SESSION['USER_IMAGE'])?$_SESSION['USER_IMAGE']:'/images/profile.png';
    $LOGIN_USER_IMAGE = ($LOGIN_USER_IMAGE=='')?'/images/profile.png':$LOGIN_USER_IMAGE;
}

