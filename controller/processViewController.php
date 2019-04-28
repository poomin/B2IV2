<?php
/**
 * Created by PhpStorm.
 * User: PF0T4E5G
 * Date: 19/4/2562
 * Time: 01:15 ก่อนเที่ยง
 */

require_once __DIR__.'/../model/MainProjectModel.php';
require_once __DIR__.'/../model/MainPhaseModel.php';

require_once __DIR__.'/../model/ProjectModel.php';
require_once __DIR__.'/../model/ProjectPhaseModel.php';
require_once __DIR__.'/../model/ProjectUploadModel.php';
require_once __DIR__.'/../model/SchoolModel.php';

$MMain = new MainProjectModel();
$MMPhase = new MainPhaseModel();
$MPro = new ProjectModel();
$MSchool = new SchoolModel();
$MPhase = new ProjectPhaseModel();
$MUpload = new ProjectUploadModel();

$this_pro_id = $MPro->getInput('pid','0');
$this_pro_name = '';
$this_pro_en = '';
$this_pro_school = '';
$this_pro_province = '';
$this_pro_address = '';

$this_main_id = '';
$this_main_year = '';
$this_main_name = '';
$this_main_name_en = '';


$result = $MPro->selectThis(['id'=>$this_pro_id]);
$PHASES = [];
if(isset($result['id'])){
    $this_pro_name = $result['name'];
    $this_pro_en = $result['name_en'];
    $this_pro_school = $result['project_school'];
    $this_main_id = $result['main_id'];
    $result = $MSchool->selectThis(['school_name'=>$result['project_school']]);
    if(isset($result['id'])){
        $this_pro_province = $result['province'];
        if(!($result['address']=='' || $result['address']=='-')){
            $this_pro_address .=" ".$result['address'];
        }
        if(!($result['subdistrict']=='' || $result['subdistrict']=='-')){
            $this_pro_address .=" ต.".$result['subdistrict'];
        }
        if(!($result['district']=='' || $result['district']=='-')){
            $this_pro_address .=" อ.".$result['district'];
        }
        if(!($result['province']=='' || $result['province']=='-')){
            $this_pro_address .=" จ.".$result['province'];
        }
        if(!($result['code']=='' || $result['code']=='-')){
            $this_pro_address .=" ".$result['code'];
        }
    }


    $result = $MMain->selectThis(['id'=>$this_main_id]);
    if(isset($result['id'])) {
        $this_main_id = $result['id'];
        $this_main_year = $result['main_year'];
        $this_main_name = $result['name'];
        $this_main_name_en = $result['name_en'];
    }

    $sql = 'WHERE main_id = '.$this_main_id.' ORDER BY sq ASC';
    $result = $MMPhase->selectSqlAll($sql);
    if(count($result)>0){
        $PHASES = $result;

        foreach ($PHASES as $key=>$item){
            $i_phase_id = '0';
            $i_phase_status = '';
            $i_phase_message = '';
            $i_docs = [];
            $i_pdf = [];
            $i_image = [];
            $i_video = [];
            $result = $MPhase->selectThis(['project_id'=>$this_pro_id,'sq'=>$item['sq']]);
            if(isset($result['id'])){
                $i_phase_id = $result['id'];
                $i_phase_status = $result['phase_status'];
                $i_phase_message = $result['message'];
                $result = $MUpload->selectThisAll(['phase_id'=>$i_phase_id]);
                foreach ($result as $k => $i){
                    if( strtoupper($i['upload_type'])=='DOC'){
                        $i_docs[] = $i;
                    }
                    elseif (strtoupper($i['upload_type'])=='PDF'){
                        $i_pdf[] = $i;
                    }
                    elseif (strtoupper($i['upload_type'])=='IMAGE'){
                        $i_image[] = $i;
                    }
                    elseif (strtoupper($i['upload_type'])=='VIDEO'){
                        $i_video[] = $i;
                    }
                }
            }
            $PHASES[$key]['phase_status']=$i_phase_status;
            $PHASES[$key]['phase_message']=$i_phase_message;
            $PHASES[$key]['DOC']= $i_docs;
            $PHASES[$key]['PDF']= $i_pdf;
            $PHASES[$key]['IMAGE']= $i_image;
            $PHASES[$key]['VIDEO']= $i_video;
        }
    }


}
else{
    header( "location: /lprocess.php" );
    exit(0);
}