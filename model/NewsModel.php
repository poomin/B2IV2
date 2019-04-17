<?php
/**
 * Created by PhpStorm.
 * User: PF0T4E5G
 * Date: 9/4/2562
 * Time: 10:59 หลังเที่ยง
 */

require_once __DIR__.'/_DBPDO.php';

class NewsModel extends _DBPDO
{
    public $DB = "b2i_news";

    function insertThis($input){
        $this_db = $this->DB;

        $data_sql = $this->convertArrayToInsert($input);
        if(count($data_sql)<=0){
            return 0;
        }else{

            //connect DB
            $this->connect();
            $sql_value = $data_sql['value'];
            $sql = "INSERT INTO $this_db $sql_value";
            $params = $data_sql['params'];
            $lastId = $this->insert($sql,$params);

            //close DB
            $this->close();
            return $lastId;
        }
    }
    function editThis($input , $condition){
        $this_db = $this->DB;

        $data_sql = $this->convertArrayToUpdate($input,$condition);

        if(count($data_sql['params'])<=0){
            return 0;
        }else {
            //connect DB
            $this->connect();
            $sql_value = $data_sql['value'];
            $sql = "UPDATE $this_db $sql_value";
            $params = $data_sql['params'];
            $lastId = $this->update($sql,$params);

            //close DB
            $this->close();
            return $lastId;
        }
    }
    function deleteThis($condition){
        $this_db = $this->DB;
        //set parameter

        $data_sql = $this->convertArrayToCondition($condition);
        $sql_value = $data_sql['value'];
        $params = $data_sql['params'];

        //connect DB
        $this->connect();
        $sql = "DELETE FROM $this_db ".$sql_value;
        $rowUpdate = $this->update($sql,$params);
        //close DB
        $this->close();


        return $rowUpdate;
    }

    function selectThis($condition){
        //set parameter
        $this_db = $this->DB;

        //condition
        $data_sql = $this->convertArrayToCondition($condition);
        $sql_value = $data_sql['value'];
        $params = $data_sql['params'];

        //connect DB
        $this->connect();
        $sql = "SELECT * FROM $this_db ".$sql_value;
        $result = $this->query($sql,$params);
        //close DB
        $this->close();


        return $result;

    }
    function selectThisAll($condition){
        //set parameter
        $this_db = $this->DB;

        //condition
        $data_sql = $this->convertArrayToCondition($condition);
        $sql_value = $data_sql['value'];
        $params = $data_sql['params'];

        //connect DB
        $this->connect();
        $sql = "SELECT * FROM $this_db ".$sql_value;
        $result = $this->queryAll($sql,$params);
        //close DB
        $this->close();


        return $result;

    }
    function selectSql($strSql){
        //set parameter
        $this_db = $this->DB;

        //connect DB
        $this->connect();
        $sql = "SELECT * FROM $this_db ".$strSql;
        $params= array();
        $result = $this->query($sql,$params);
        //close DB
        $this->close();


        return $result;

    }
    function selectSqlAll($strSql){
        //set parameter
        $this_db = $this->DB;

        //connect DB
        $this->connect();
        $sql = "SELECT * FROM $this_db ".$strSql;
        $params= array();
        $result = $this->queryAll($sql,$params);
        //close DB
        $this->close();


        return $result;

    }


    function countView($news_id){
        $this_db = $this->DB;

        //connect DB
        $this->connect();
        $sql = "update $this_db set view_count = view_count+1 where id=".$news_id;
        $params = [];
        $lastId = $this->update($sql,$params);

        //close DB
        $this->close();
        return $lastId;

    }
    function countComment($news_id){
        $this_db = $this->DB;

        //connect DB
        $this->connect();
        $sql = "update $this_db set comment_count = comment_count+1 where id=".$news_id;
        $params = [];
        $lastId = $this->update($sql,$params);

        //close DB
        $this->close();
        return $lastId;

    }
    function subComment($news_id){
        $this_db = $this->DB;

        //connect DB
        $this->connect();
        $sql = "update $this_db set comment_count = comment_count-1 where id=".$news_id;
        $params = [];
        $lastId = $this->update($sql,$params);

        //close DB
        $this->close();
        return $lastId;

    }

}