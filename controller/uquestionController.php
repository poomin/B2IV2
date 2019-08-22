<?php

require_once __DIR__.'/../model/QuestionModel.php';

$MQuestion = new QuestionModel();

$QUESTIONS = [];

$LOGIN_USER_ID = isset($LOGIN_USER_ID)?$LOGIN_USER_ID:0;

$whereSql = ' WHERE user_id='.$LOGIN_USER_ID.' ORDER BY update_at DESC' ;

$result = $MQuestion->selectSqlAll($whereSql);
if(count($result)>0){
    $QUESTIONS = $result;
}
