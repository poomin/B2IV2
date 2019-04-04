<?php
/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 6/7/2017
 * Time: 12:22 PM
 */

header('content-type: application/json;charset=utf-8');
session_start();

$type  = isset($_REQUEST['type'])?$_REQUEST['type']:'';
$user_id = isset($_REQUEST['user_id'])?$_REQUEST['user_id']:'0';

$type = strtolower($type);
$host = $_SERVER['SERVER_NAME'];
if($host=='localhost'){
    $targetFolder = '/upload/'.$type;  //for localhost
}else{
    $targetFolder = '/upload/'.$type;    //for server
}


if (!empty($_FILES)) {
    $tempFile = $_FILES['fileToUpload']['tmp_name'];
    $targetPath = $_SERVER['DOCUMENT_ROOT']. $targetFolder;
    $extension = strtolower(pathinfo($_FILES['fileToUpload']['name'], PATHINFO_EXTENSION));
    $name_file = $_FILES['fileToUpload']['name'];
    $cut_name = explode('.',$name_file);

    $nameImage = $cut_name[0];

    $t=time();
    if($type=='video') {
        $change_name = $type . '_' . $t . '.mp4';
    }elseif ($type=='profile'){
        $change_name = 'profile'.$user_id.'.'.$extension;
    }else{
        $change_name = $type.'_'.$t.'.'.$extension;
    }

    $targetFile = rtrim($targetPath, '/') . '/'.$change_name;

    // Validate the file type
    $fileParts = pathinfo($_FILES['fileToUpload']['name']);

    $remove = $_SERVER['DOCUMENT_ROOT'].''.$targetFolder.'/'.$change_name;

    //remove file
    if(file_exists($remove))unlink($remove);

    if(move_uploaded_file($tempFile, $targetFile)){
        chmod($targetFile, 0777);
        if ($type=='profile'){
            $user_id_login = isset($_SESSION['USER_ID'])?$_SESSION['USER_ID']:'';
            if($user_id_login==$user_id){
                $_SESSION['USER_IMAGE'] = '/upload/profile/'.$change_name;
            }
        }
        echo json_encode([
            'status'=>'ok',
            'message'=> 'Upload image success.',
            'file_name'=> $nameImage,
            'new_name'=> $change_name,
        ]);
    }else {
        echo json_encode([
            'status' => 'error',
            'message' => error_get_last(),//"Upload image fail!",
            'file_name' => ''
        ]);
    }


}else{
    echo json_encode([
        'status'=>'error',
        'message'=> 'upload is empty!',
        'file_name'=>''
    ]);
}