<?php

require_once __DIR__.'/../model/QuestionModel.php';
require_once __DIR__.'/../model/QuestionCommentModel.php';
require_once __DIR__.'/../model/UserModel.php';

$MU = new UserModel();
$MQuestion = new QuestionModel();
$MQComment = new QuestionCommentModel();

$LOGIN_USER_ID = isset($LOGIN_USER_ID)?$LOGIN_USER_ID:0;
$question_id = $MQuestion->getInput('qid',0);
$this_title = '';
$this_detail = '';
$this_create_at = '';

$this_name = '';
$this_school = '';
$this_role = '';
$this_region = '';

$COMMENTS = [];


//>>>>>>>>>>>>>> function
$fn = $MQComment->getInput('fn');
if($fn=='addComment'){

    $_user_id = $LOGIN_USER_ID;
    $_question_id = $question_id;
    $_comment = $MQComment->getInput('comment',0);

    $raw = [
        'question_id'=> $_question_id,
        'user_id'=> $_user_id,
        'comment_text'=> $_comment
    ];
    $last_id = $MQComment->insertThis($raw);
    if($last_id >0){

        $raw = [
            'user_read'=>'N'
        ];
        $condition = [
            'id'=> $_question_id
        ];
        $result = $MQuestion->editThis($raw,$condition);

        $_SESSION['action_status']='success';
        $_SESSION['action_message']='Send comment success.';
    }
    else{
        $_SESSION['action_status']='warning';
        $_SESSION['action_message']='Send comment fail!!!';
    }

}
elseif ($fn=='editComment'){
    $_comment_id = $MQComment->getInput('comment_id',0);
    $_comment = $MQComment->getInput('comment',0);
    $last_id = $MQComment->editThis(['comment_text'=>$_comment],['id'=>$_comment_id]);
    if($last_id >0){
        $_SESSION['action_status']='success';
        $_SESSION['action_message']='Edit comment success.';
    }
    else{
        $_SESSION['action_status']='warning';
        $_SESSION['action_message']='Edit comment fail!!!';
    }
}

elseif ($fn=='modalDelete'){
    $_comment_id = $MQComment->getInput('delete_id',0);
    $last_id = $MQComment->deleteThis(['id'=>$_comment_id]);
    if($last_id >0){
        $_SESSION['action_status']='success';
        $_SESSION['action_message']='Delete comment success.';
    }
    else{
        $_SESSION['action_status']='warning';
        $_SESSION['action_message']='Delete comment fail!!!';
    }
}


//>>>>>>>>>>>>>> view

$condition = [
    'id'=> $question_id,
];
$result = $MQuestion->selectThis($condition);
if(isset($result['id'])){
    $this_title = $result['title'];
    $this_detail = $result['detail'];
    $this_create_at = $result['create_at'];
    $this_admin_read = $result['admin_read'];
    $this_user_id = $result['user_id'];

    //user comment
    $result = $MU->selectThis(['id'=>$this_user_id]);
    if(isset($result['id'])){
        $this_name = $result['name_title'].''.$result['name'].' '.$result['surname'];
        $this_school = $result['schoolname'];
        $this_role = $result['role'];
        $this_region = $result['schoolregion'];
    }

    //update user read
    if($this_admin_read=='N'){
        $raw = [
            'admin_read'=>'Y'
        ];
        $condition = [
            'id'=> $question_id
        ];
        $result = $MQuestion->editThis($raw,$condition);
    }

    //set read question by admin
    $condition = [
        'admin_read'=>'N'
    ];
    $result = $MQuestion->selectThisAll($condition);
    $COUNT_QUESTION = count($result);
    $_SESSION['COUNT_QUESTION'] = $COUNT_QUESTION;


    $sql = 'SELECT qc.* , u.name , u.surname FROM b2i_question_comment AS qc 
LEFT JOIN b2i_user AS u ON qc.user_id = u.id
WHERE qc.question_id = '.$question_id.' ORDER BY qc.create_at DESC';
    $result = $MQComment->sqlAll($sql);
    if(count($result)>0){
        $COMMENTS = $result;
    }
}
else{
    $_SESSION['action_status']='warning';
    $_SESSION['action_message']='Not found Question!!!';
    header( "location: /lquestion.php" );
    exit(0);
}
