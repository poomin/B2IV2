<?php

require_once __DIR__.'/../model/QuestionModel.php';
require_once __DIR__.'/../model/QuestionCommentModel.php';

$MQuestion = new QuestionModel();
$MQComment = new QuestionCommentModel();

$LOGIN_USER_ID = isset($LOGIN_USER_ID)?$LOGIN_USER_ID:0;
$question_id = $MQuestion->getInput('qid',0);
$this_title = '';
$this_detail = '';
$this_create_at = '';
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
            'admin_read'=>'N'
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


//>>>>>>>>>>>>>> view

$condition = [
  'id'=> $question_id,
  'user_id' => $LOGIN_USER_ID
];
$result = $MQuestion->selectThis($condition);
if(isset($result['id'])){
    $this_title = $result['title'];
    $this_detail = $result['detail'];
    $this_create_at = $result['create_at'];
    $this_user_read = $result['user_read'];

    //update user read
    if($this_user_read=='N'){
        $raw = [
            'user_read'=>'Y'
        ];
        $condition = [
            'id'=> $question_id
        ];
        $result = $MQuestion->editThis($raw,$condition);
    }


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
    header( "location: /uquestion.php" );
    exit(0);
}






