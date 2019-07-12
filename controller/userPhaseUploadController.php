<?php
/**
 * Created by PhpStorm.
 * User: PF0T4E5G
 * Date: 17/4/2562
 * Time: 07:36 หลังเที่ยง
 */

require_once __DIR__.'/../model/MainProjectModel.php';
require_once __DIR__.'/../model/MainPhaseModel.php';

require_once __DIR__.'/../model/ProjectModel.php';
require_once __DIR__.'/../model/ProjectMemberModel.php';
require_once __DIR__.'/../model/ProjectPhaseModel.php';
require_once __DIR__.'/../model/ProjectUploadModel.php';

$MMain = new MainProjectModel();
$MPhase = new MainPhaseModel();

$MPro = new ProjectModel();
$MProMember = new ProjectMemberModel();
$MProPhase = new ProjectPhaseModel();
$MProUpload = new ProjectUploadModel();

$ss_user_id = $LOGIN_USER_ID;

$url_pro_id = $MPro->getInput('pid');
$url_sq = $MPro->getInput('nsq');


$fn = $MMain->getInput('fn');
if($fn=='addDoc'){
    $p_phase_id = $MProUpload->getInput('phase_id');
    $p_upload_type = $MProUpload->getInput('type');
    $p_upload_name = $MProUpload->getInput('nameFile');
    $p_upload_path = $MProUpload->getInput('path');

    $raw =[
        'phase_id'=>$p_phase_id,
        'upload_type'=>$p_upload_type,
        'upload_name'=>$p_upload_name,
        'upload_path'=>$p_upload_path
    ];

    $update_rows = $MProUpload->insertThis($raw);

    if( $update_rows > 0){
        $_SESSION['action_status']='success';
        $_SESSION['action_message']='Upload doc success.';
    }else{
        $_SESSION['action_status']='warning';
        $_SESSION['action_message']='Upload doc fail!!!';
    }


}
elseif($fn=='addPdf'){
    $p_phase_id = $MProUpload->getInput('phase_id');
    $p_upload_type = $MProUpload->getInput('type');
    $p_upload_name = $MProUpload->getInput('nameFile');
    $p_upload_path = $MProUpload->getInput('path');

    $raw =[
        'phase_id'=>$p_phase_id,
        'upload_type'=>$p_upload_type,
        'upload_name'=>$p_upload_name,
        'upload_path'=>$p_upload_path
    ];

    $update_rows = $MProUpload->insertThis($raw);

    if( $update_rows > 0){
        $_SESSION['action_status']='success';
        $_SESSION['action_message']='Upload pdf success.';
    }else{
        $_SESSION['action_status']='warning';
        $_SESSION['action_message']='Upload pdf fail!!!';
    }


}
elseif($fn=='addImage'){
    $p_phase_id = $MProUpload->getInput('phase_id');
    $p_upload_type = $MProUpload->getInput('type');
    $p_upload_name = $MProUpload->getInput('nameFile');
    $p_upload_path = $MProUpload->getInput('path');

    $raw =[
        'phase_id'=>$p_phase_id,
        'upload_type'=>$p_upload_type,
        'upload_name'=>$p_upload_name,
        'upload_path'=>$p_upload_path
    ];

    $update_rows = $MProUpload->insertThis($raw);

    if( $update_rows > 0){
        $_SESSION['action_status']='success';
        $_SESSION['action_message']='Upload img success.';
    }else{
        $_SESSION['action_status']='warning';
        $_SESSION['action_message']='Upload img fail!!!';
    }


}
elseif($fn=='addVideo'){
    $p_phase_id = $MProUpload->getInput('phase_id');
    $p_upload_type = $MProUpload->getInput('type');
    $p_upload_name = $MProUpload->getInput('nameFile');
    $p_upload_path = $MProUpload->getInput('path');

    $raw =[
        'phase_id'=>$p_phase_id,
        'upload_type'=>$p_upload_type,
        'upload_name'=>$p_upload_name,
        'upload_path'=>$p_upload_path
    ];

    $update_rows = $MProUpload->insertThis($raw);

    if( $update_rows > 0){
        $_SESSION['action_status']='success';
        $_SESSION['action_message']='Upload img success.';
    }else{
        $_SESSION['action_status']='warning';
        $_SESSION['action_message']='Upload img fail!!!';
    }


}

elseif($fn=='modalDelete'){

    $delete_id = $MProUpload->getInput('delete_id');

    $condition = [
        'id'=>$delete_id
    ];


    $user_row = $MProUpload->deleteThis($condition);
    if($user_row >0){
        $_SESSION['action_status']='success';
        $_SESSION['action_message']='Delete success.';

    }
    else{
        $_SESSION['action_status']='warning';
        $_SESSION['action_message']='Delete fail!!!';
    }

}


$this_pro_id = '';
$this_pro_name = '';
$this_pro_name_en = '';

//------------------------ fore show main ----------------
$this_main_id = '';
$this_main_year = '';
$this_main_name = '';
$this_main_name_en = '';
$this_mp_id='';
$this_mp_sq = '';
$this_mp_title='';
$this_mp_detail='';
$this_mp_doc='';
$this_mp_pdf='';
$this_mp_img='';
$this_mp_video='';
$this_mp_start='';
$this_mp_end = '';
$result = $MMain->selectThis(['main_status'=>'Y']);
if(isset($result['id'])) {
    $this_main_id = $result['id'];
    $this_main_year = $result['main_year'];
    $this_main_name = $result['name'];
    $this_main_name_en = $result['name_en'];

    $result = $MPhase->selectThis(['main_id'=>$this_main_id,'sq'=>$url_sq]);
    if(isset($result['id'])){
        $this_mp_id=$result['id'];
        $this_mp_sq = $result['sq'];
        $this_mp_title=$result['title'];
        $this_mp_detail=$result['detail'];
        $this_mp_doc=$result['upload_doc'];
        $this_mp_pdf=$result['upload_pdf'];
        $this_mp_img=$result['upload_image'];
        $this_mp_video=$result['upload_video'];
        $this_mp_start=$result['date_start'];
        $this_mp_end = $result['date_end'];
    }else{
        header( "location: /uprocess.php" );
        exit(0);
    }
}else{
    header( "location: /uprocess.php" );
    exit(0);
}
//--------------------------------------------------------


$result = $MProMember->selectThis(['project_id'=>$url_pro_id , 'user_id'=>$ss_user_id]);
if(isset($result['id'])){
    $this_pro_id = $result['project_id'];
    $result = $MPro->selectThis(['id'=>$this_pro_id]);
    if(isset($result['id'])){
        $this_pro_name = $result['name'];
        $this_pro_name_en = $result['name_en'];
        $this_main_id = $result['main_id'];
    }
}else{
    header( "location: /uprocess.php" );
    exit(0);
}

//------------------- status ----------------------------
$_STATUS = '';
$c_fail = 0;
$c_pass = 0;
$c_non = 0;

$t_this = date('Y-m-d');
$t_this = strtotime($t_this);
$t_start = strtotime($this_mp_start);
$t_end = strtotime($this_mp_end);

$result = $MProPhase->selectThisAll(['project_id'=>$this_pro_id]);
foreach ($result as $key=>$item){
    if($item['phase_status']=='FAIL'){
        $c_fail = $c_fail+1;
    }elseif ($item['phase_status']=='PASS'){
        $c_pass = $c_pass+1;
    }else{
        $c_non = $c_non+1;
    }
}

if($c_fail>0){
    $_STATUS = 'fail';
}
else{
    if($this_mp_sq <= 1){
        if($t_start<= $t_this && $t_this <= $t_end){

            $time_house  = intval(date("H"));

            if( $t_this == $t_end && $time_house > 8 ){
                $_STATUS = 'close';
            }else{
                $_STATUS = 'open';
            }
        }else{
            $_STATUS = 'close';
        }
    }else{
        if($t_start<= $t_this && $t_this <= $t_end){
            if( intval($c_pass) == intval($this_mp_sq)-1){
                $_STATUS = 'open';
            }else{
                $_STATUS = 'wait';
            }
        }else{
            $_STATUS = 'close';
        }
    }
}
//--------------------------------------------------------

$this_phase_id = '';
$this_phase_message = '';
$this_phase_status = '';
$result = $MProPhase->selectThis(['project_id'=>$this_pro_id,'sq'=>$this_mp_sq]);
if($result['id']){
    $this_phase_id = $result['id'];
    $this_phase_status = $result['phase_status'];
    $this_phase_message = $result['message'];
}
else{
    if ($_STATUS=='open'){
        $raw = [
            'project_id'=>$this_pro_id,
            'sq'=>$this_mp_sq,
            'phase_status'=>'NON'
        ];
        $this_phase_id = $MProPhase->insertThis($raw);
    }
}

$DOCS = [];
$PDFS = [];
$IMAGES = [];
$VIDEOS = [];

if($this_phase_id!=''){
    $result = $MProUpload->selectThisAll(['phase_id'=>$this_phase_id]);
    foreach ($result as $key=>$item){
        if($item['upload_type']=='PDF'){
            $PDFS[] = $item;
        }elseif ($item['upload_type']=='DOC'){
            $DOCS[] = $item;
        }elseif ($item['upload_type']=='VIDEO'){
            $VIDEOS[] = $item;
        }elseif ($item['upload_type']=='IMAGE'){
            $IMAGES[] = $item;
        }
    }
}













