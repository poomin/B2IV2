<?php
/**
 * Created by PhpStorm.
 * User: PF0T4E5G
 * Date: 9/4/2562
 * Time: 11:37 หลังเที่ยง
 */

require_once __DIR__.'/../model/NewsModel.php';
$MNews = new NewsModel();

$this_news_id =  $MNews->getInput('id',999999);
$this_function = 'new';
$this_image = '/upload/news/null.png';

$this_title = '';
$this_detail = '';
$this_news_type = '';

$result = $MNews->selectThis(['id'=>$this_news_id]);
if(isset($result['id'])){
    $this_function = 'edit';
    $this_image = $result['image']==''?$this_image:$result['image'];

    $this_title = $result['title'];
    $this_detail = $result['detail'];
    $this_news_type = $result['news_type'];

}

