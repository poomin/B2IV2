<?php

require_once __DIR__.'/../model/QuestionModel.php';

$MQuestion = new QuestionModel();

$LOGIN_USER_ID = isset($LOGIN_USER_ID)?$LOGIN_USER_ID:0;



//>>>>>>>>>>>>>> function
$fn = $MQuestion->getInput('fn');
if($fn=='addQuestion'){

    $user_id = $LOGIN_USER_ID;
    $_title = $MQuestion->getInput('title',0);
    $_detail = $MQuestion->getInput('detail',0);

    $raw = [
        'user_id'=>$user_id,
        'title'=> $_title,
        'detail'=> $_detail
    ];


    $last_id = $MQuestion->insertThis($raw);
    if($last_id >0){
        $_SESSION['action_status']='success';
        $_SESSION['action_message']='Send question success.';
        header( "location: /uquestion.php" );
        exit(0);
    }
    else{
        $_SESSION['action_status']='warning';
        $_SESSION['action_message']='Send question fail!!!';
    }

}

