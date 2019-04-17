<?php
/**
 * Created by PhpStorm.
 * User: PF0T4E5G
 * Date: 10/4/2562
 * Time: 01:24 ก่อนเที่ยง
 */

require_once __DIR__.'/../model/NewsModel.php';
require_once __DIR__.'/../model/CommentModel.php';
$MNews = new NewsModel();
$MComm = new CommentModel();

$COMMENTS = [];
$this_news_id = $MNews->getInput('nid');
$this_image = '';
$this_title = '';
$this_detail = '';
$this_create_at = '';
$this_view_count = 0;
$this_comment_count =0;
$this_new_type = '';


$fn = $MComm->getInput('fn');
if($fn=='addComment'){
   $p_user_id = $MComm->getInput('user_id');
   $p_news_id = $this_news_id;
   $p_comment = $MComm->getInput('comment');

   $raw = [
       'news_id'=>$p_news_id,
       'user_id'=>$p_user_id,
       'comment'=>$p_comment
   ];

   $count_rows = $MComm->insertThis($raw);
    if($count_rows >0){
        $result = $MNews->countComment($this_news_id);
    }

}

else{
    $result = $MNews->countView($this_news_id);
}



$result = $MNews->selectThis(['id'=>$this_news_id]);
if(isset($result['id'])){
    $this_image = $result['image'];
    $this_title = $result['title'];
    $this_detail = $result['detail'];
    $this_view_count = $result['view_count'];
    $this_comment_count = $result['comment_count'];
    $this_create_at = $result['create_at'];
    $this_new_type = $result['news_type'];
}

$result = $MComm->selectCommentNewsId($this_news_id);
if(count($result)>0){
    $COMMENTS = $result;
}





