<?php
/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 4/4/2019
 * Time: 3:04 PM
 */

require_once __DIR__ . '/../model/UserModel.php';
$MUser = new UserModel();

$USERS = [];



//>>>>>>>>>>>>>>> in page

//school
$sql = " WHERE role!='admin' AND userremove='n';";
$result = $MUser->selectSqlAll($sql);
if(count($result)>0){
    $USERS = $result;
}

