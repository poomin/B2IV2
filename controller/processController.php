<?php
/**
 * Created by PhpStorm.
 * User: PF0T4E5G
 * Date: 19/4/2562
 * Time: 01:15 ก่อนเที่ยง
 */

require_once __DIR__.'/../model/MainProjectModel.php';
require_once __DIR__.'/../model/MainPhaseModel.php';

$MMain = new MainProjectModel();
$MMPhase = new MainPhaseModel();

$this_main_id = '';
$this_main_year = '';
$this_main_name = '';
$this_main_name_en = '';

$PHASES = [];

$result = $MMain->selectThis(['main_status'=>'Y']);
if(isset($result['id'])) {
    $this_main_id = $result['id'];
    $this_main_year = $result['main_year'];
    $this_main_name = $result['name'];
    $this_main_name_en = $result['name_en'];

    $sql = " WHERE main_id = $this_main_id ORDER BY sq ASC";
    $result = $MMPhase->selectSqlAll($sql);

    if(count($result)>0){
        $PHASES = $result;
        foreach ($PHASES as $key=>$item){
            $count_all = 0;
            $count_pass = 0;
            $count_fail = 0;
            $sql= 'select phase.* from b2i_project as pro left join b2i_project_phase as phase on pro.id = phase.project_id where pro.main_id = '.$item['main_id'];
            $sqlAll = $sql;
            if($item['sq'] == 1){
                $sql = $sql. ' and ( phase.sq = '.$item['sq'] . ' or phase.sq IS NULL )';
                $sqlAll = $sqlAll. ' and ( phase.sq = '.$item['sq'] . ' or phase.sq IS NULL )';
            }else{
                $sql = $sql. ' and phase.sq = '.$item['sq'];
                $sqlAll = $sqlAll. ' and phase.sq = '.(intval($item['sq'])-1) . ' and phase.phase_status ="PASS"';
            }
            $result = $MMain->sqlAll($sql);
            foreach ($result as $k=>$i){
                $count_all = $count_all+1;
                if($i['phase_status']=='PASS'){
                    $count_pass = $count_pass+1;
                }elseif ($i['phase_status']=='FAIL'){
                    $count_fail = $count_fail+1;
                }
            }
            $result = $MMain->sqlAll($sqlAll);
            $PHASES[$key]['count_all'] = count($result);
            $PHASES[$key]['count_pass'] = $count_pass;
            $PHASES[$key]['count_fail'] = $count_fail;
        }
    }
}