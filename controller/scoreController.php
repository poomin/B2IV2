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

$LOGIN_USER_ID = isset($LOGIN_USER_ID)?$LOGIN_USER_ID:0;

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
            $sql= 'SELECT mp.* FROM b2i_main_map AS mp
LEFT JOIN b2i_main_board AS board ON board.group_id = mp.main_group_id
WHERE mp.sq = '.$item['sq'].' AND board.main_id='.$item['main_id'].' AND board.user_id='.$LOGIN_USER_ID;
            $result = $MMain->sqlAll($sql);
            $PHASES[$key]['count_all'] = count($result);
        }
    }
}