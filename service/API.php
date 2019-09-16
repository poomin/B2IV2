<?php
/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 2/22/2019
 * Time: 3:37 PM
 */


function formatDmy($dmy){
    $cut = explode('/',$dmy);
    if(count($cut)>=2){
        return $cut[2].'-'.$cut[1].'-'.$cut[0];
    }else{
        return date('Y-m-d');
    }
}



$fn = isset($_REQUEST['fn'])?$_REQUEST['fn']:'';

//>>>>>>>>>> user
if($fn == 'addUserImage'){
    require_once __DIR__.'/../model/UserModel.php';
    $MUser = new UserModel();
    $user_id = $MUser->getInput('uid');
    $src = $MUser->getInput('src');

    $update_rows = $MUser->editThis(['image_path'=>$src],['id'=>$user_id]);

    echo json_encode(['status'=>true]);
    exit(0);
}



//>>>>>>>>>>>>> WEB
elseif($fn == 'addEditWebInfo'){
    require_once __DIR__.'/../model/WebModel.php';
    $MWeb = new WebModel();

    $web_id = $MWeb->getInput('web_id');
    $web_home = $MWeb->getInput('web_home');

    $update_rows =  $MWeb->editThis(['web_home'=>$web_home],['id'=>$web_id]);

    if($update_rows >0){
        echo json_encode(['status'=>true]);
        exit(0);
    }else{
        echo json_encode(['status'=>false]);
        exit(0);
    }


}
elseif($fn == 'getWebInfo'){
    require_once __DIR__.'/../model/WebModel.php';
    $MWeb = new WebModel();

    $web_id = $MWeb->getInput('web_id');

    $result =  $MWeb->selectThis(['id'=>$web_id]);

    if(isset($result['id'])){
        echo json_encode(['status'=>true , 'data'=>$result['web_home']]);
        exit(0);
    }else{
        echo json_encode(['status'=>false , 'data'=>'']);
        exit(0);
    }


}
elseif($fn == 'addEditWebInformation'){
    require_once __DIR__.'/../model/WebModel.php';
    $MWeb = new WebModel();

    $web_id = $MWeb->getInput('web_id');
    $web_information = $MWeb->getInput('web_information');

    $update_rows =  $MWeb->editThis(['web_info'=>$web_information],['id'=>$web_id]);

    if($update_rows >0){
        echo json_encode(['status'=>true]);
        exit(0);
    }else{
        echo json_encode(['status'=>false]);
        exit(0);
    }


}
elseif($fn == 'getWebInformation'){
    require_once __DIR__.'/../model/WebModel.php';
    $MWeb = new WebModel();

    $web_id = $MWeb->getInput('web_id');

    $result =  $MWeb->selectThis(['id'=>$web_id]);

    if(isset($result['id'])){
        echo json_encode(['status'=>true , 'data'=>$result['web_info']]);
        exit(0);
    }else{
        echo json_encode(['status'=>false , 'data'=>'']);
        exit(0);
    }


}
//-------- image
elseif ($fn=='addWebImage'){
    require_once __DIR__.'/../model/WebImageModel.php';
    $MWebImage = new WebImageModel();

    $web_id = $MWebImage->getInput('wid');
    $web_image = $MWebImage->getInput('src');

    $update_rows =  $MWebImage->insertThis(['web_id'=>$web_id , 'web_image'=>$web_image]);

    if($update_rows > 0){
        echo json_encode(['status'=>true]);
        exit(0);
    }else{
        echo json_encode(['status'=>false]);
        exit(0);
    }


}


//>>>>>>>>>>>>> News
elseif($fn == 'addNews'){
    require_once __DIR__.'/../model/NewsModel.php';
    $MNews = new NewsModel();

    $title = $MNews->getInput('title');
    $image = $MNews->getInput('image');
    $detail = $MNews->getInput('detail');
    $news_type = $MNews->getInput('type');

    $raw = [
      'title'=>$title,
      'image'=>$image,
      'detail'=>$detail,
      'news_type'=>$news_type
    ];

    $add_id =  $MNews->insertThis($raw);

    if($add_id >0){
        echo json_encode(['status'=>true , 'id'=>$add_id]);
        exit(0);
    }else{
        echo json_encode(['status'=>false , 'id'=>0]);
        exit(0);
    }


}
elseif($fn == 'editNews'){
    require_once __DIR__.'/../model/NewsModel.php';
    $MNews = new NewsModel();

    $news_id = $MNews->getInput('newsId');
    $title = $MNews->getInput('title');
    $image = $MNews->getInput('image');
    $detail = $MNews->getInput('detail');
    $news_type = $MNews->getInput('type');

    $raw = [
        'title'=>$title,
        'image'=>$image,
        'detail'=>$detail,
        'news_type'=>$news_type
    ];

    $condition = [
        'id'=>$news_id
    ];

    $update_rows =  $MNews->editThis($raw,$condition);

    if($update_rows >0){
        echo json_encode(['status'=>true]);
        exit(0);
    }else{
        echo json_encode(['status'=>false]);
        exit(0);
    }


}
elseif ($fn=='loadNews'){
    require_once __DIR__.'/../model/NewsModel.php';
    $MNews = new NewsModel();

    $page = $MNews->getInput('page');
    $page = ($page==0)?1*5:$page*5;
    $sql = ' order by create_at DESC limit '.$page.' , 5 ';

    $result = $MNews->selectSqlAll($sql);

    echo json_encode(['status'=>true , 'result'=>$result]);
    exit(0);

}

//>>>>>>>>>>>>> Hall
elseif ($fn=='addHall'){
    require_once __DIR__.'/../model/HallModel.php';
    $MHall = new HallModel();

    $project_name = $MHall->getInput('project_name');
    $project_name_en = $MHall->getInput('project_name_en');
    $image = $MHall->getInput('image');
    $adviser_name = $MHall->getInput('adviser_name');
    $student_1 = $MHall->getInput('student_1');
    $student_2 = $MHall->getInput('student_2');
    $student_3 = $MHall->getInput('student_3');
    $student_4 = $MHall->getInput('student_4');
    $detail = $MHall->getInput('detail');

    $raw = [
        'project_name'=>$project_name,
        'project_name_en'=>$project_name_en,
        'image'=>$image,
        'adviser_name'=>$adviser_name,
        'student_1'=>$student_1,
        'student_2'=>$student_2,
        'student_3'=>$student_3,
        'student_4'=>$student_4,
        'detail'=>$detail
    ];

    $add_id =  $MHall->insertThis($raw);

    if($add_id >0){
        echo json_encode(['status'=>true , 'id'=>$add_id]);
        exit(0);
    }else{
        echo json_encode(['status'=>false , 'id'=>0]);
        exit(0);
    }


}
elseif ($fn=='editHall'){
    require_once __DIR__.'/../model/HallModel.php';
    $MHall = new HallModel();

    $hall_id = $MHall->getInput('hall_id');
    $project_name = $MHall->getInput('project_name');
    $project_name_en = $MHall->getInput('project_name_en');
    $image = $MHall->getInput('image');
    $adviser_name = $MHall->getInput('adviser_name');
    $student_1 = $MHall->getInput('student_1');
    $student_2 = $MHall->getInput('student_2');
    $student_3 = $MHall->getInput('student_3');
    $student_4 = $MHall->getInput('student_4');
    $detail = $MHall->getInput('detail');

    $raw = [
        'project_name'=>$project_name,
        'project_name_en'=>$project_name_en,
        'image'=>$image,
        'adviser_name'=>$adviser_name,
        'student_1'=>$student_1,
        'student_2'=>$student_2,
        'student_3'=>$student_3,
        'student_4'=>$student_4,
        'detail'=>$detail
    ];
    $condition = [
        'id'=>$hall_id
    ];

    $update_rows =  $MHall->editThis($raw,$condition);

    if($update_rows >0){
        echo json_encode(['status'=>true]);
        exit(0);
    }else{
        echo json_encode(['status'=>false]);
        exit(0);
    }


}
elseif ($fn=='loadHall'){
    require_once __DIR__.'/../model/HallModel.php';
    $MHall = new HallModel();

    $page = $MHall->getInput('page');
    $page = ($page==0)?1*9:$page*9;
    $sql = ' order by create_at DESC limit '.$page.' , 9 ';

    $result = $MHall->selectSqlAll($sql);


    echo json_encode(['status'=>true , 'result'=>$result]);
    exit(0);


}

//>>>>>>>>>>>>> picture , pictures
elseif ($fn=='addWebPicture'){
    require_once __DIR__.'/../model/PicturesModel.php';
    $MPics = new PicturesModel();

    $web_id = $MPics->getInput('wid');
    $web_image = $MPics->getInput('src');

    $update_rows =  $MPics->insertThis(['activity_id'=>$web_id , 'picture_path'=>$web_image]);

    if($update_rows > 0){
        echo json_encode(['status'=>true]);
        exit(0);
    }else{
        echo json_encode(['status'=>false]);
        exit(0);
    }


}
elseif ($fn=='loadPicture'){
    require_once __DIR__.'/../model/PictureModel.php';
    require_once __DIR__.'/../model/PicturesModel.php';

    $MPic = new PictureModel();
    $MPics = new PicturesModel();

    $PICS = [];

    $page = $MPic->getInput('page');
    $page = ($page==0)?1*9:$page*9;
    $sql = ' order by create_at DESC limit '.$page.' , 9 ';

    $PICS = $MPic->selectSqlAll($sql);
    foreach ($PICS as $key=>$item){
        $PICS[$key]["pictures"] = [];
        $sql = ' ORDER BY create_at DESC LIMIT 3 ';
        $result = $MPics->selectSqlAll($sql);
        if(count($result)>0){
            $PICS[$key]["pictures"] = $result;
        }
    }


    echo json_encode(['status'=>true , 'result'=>$PICS]);
    exit(0);


}

//>>>>>>>>>>>>> Phase
elseif ($fn=='insertUpdatePhase'){
    require_once __DIR__.'/../model/MainPhaseModel.php';
    $MPhase = new MainPhaseModel();
    $main_id = $MPhase->getInput('mainId');
    $sq = $MPhase->getInput('sq');
    $title = $MPhase->getInput('title');
    $detail = $MPhase->getInput('detail');
    $upload_doc = $MPhase->getInput('doc');
    $upload_pdf = $MPhase->getInput('pdf');
    $upload_image = $MPhase->getInput('image');
    $upload_video = $MPhase->getInput('video');
    $date_start = $MPhase->getInput('dateStart');
    $date_start = formatDmy($date_start);
    $date_end = $MPhase->getInput('dateEnd');
    $date_end = formatDmy($date_end);

    $raw = [
        'main_id'=>$main_id,
        'sq'=>$sq,
        'title'=>$title,
        'detail'=>$detail,
        'upload_doc'=>$upload_doc,
        'upload_pdf'=>$upload_pdf,
        'upload_image'=>$upload_image,
        'upload_video'=>$upload_video,
        'date_start'=>$date_start,
        'date_end'=>$date_end
    ];
    $condition=[
      'main_id'=>$main_id,
      'sq'=>$sq,
    ];

    $insert_rows = $MPhase->insertThis($raw);
    if($insert_rows<=0){
        $update_rows = $MPhase->editThis($raw,$condition);
    }

    echo json_encode(['status'=>true]);
    exit(0);
}






