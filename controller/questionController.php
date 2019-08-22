<?php

require_once __DIR__.'/../model/QuestionModel.php';

$MQuestion = new QuestionModel();

$QUESTIONS = [];

$whereSql = ' ORDER BY admin_read DESC , update_at DESC' ;
$result = $MQuestion->selectSqlAll($whereSql);
if(count($result)>0){
    $QUESTIONS = $result;
}
