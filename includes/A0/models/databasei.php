<?php
/*
* Author: Abdelrahman Helaly
* Contact: < AH3laly@gmail.com , https://Github.com/AH3laly >
* Project: A0 PHP Lightweight Framework (A0 for Abdo). 
* Description: Simple & Fast & Lightweight PHP Framework to quickly Create website.
* License: Science not for Monopoly.
*/

namespace A0\models;
class databasei
{
    public  $lastQuery;
    public $lastError;
    private $table;
    public $result;
    private $object;
    private $limit;
    private $where;
    
    public function __construct()
    {
       //$this->Connect();
    }
    public function connect($user, $pass, $database, $host = 'localhost')
    {
        $this->object = new \mysqli();
        $this->object->connect($host, $user, $pass, $database);
        
        $this->query("SET NAMES utf8") or die ("Couldn't set Names to UTF8 <br /> ".$this->object->errno . " : " .$this->object->error );
        if($this->object->connect_errno)
        {
            die("<div style='background-color:#fef1ec;border: 1px solid #CD0A0A;border-radius:4px;color: #CD0A0A;direction:ltr;font-family:sans-
                serif,Arial,verdana;font-size: 12px;padding:12px 7.7px'>
                <strong>Database selection failed: </strong><br />" .$this->object->connect_errno ."<br/>". $this->object->connect_error . "
                </div>");
        }
    }
    public function query($sql)
    {
        $this->lastQuery = $sql;
        $this->result = $this->object->query($sql);
        $this->table = NULL;
        $this->limit = 0;
        $this->where = NULL;
        if(!$this->result)
        {
            $this->lastError = $this->object->errno . ' : ' . $this->object->error;
            if(DEBUG_MODE)
            {
                $this->confirm_query();
            }
        }
        return $this;
    }
    public function fetchArray($key=false)
    {
        $data = array();
        if(!$this->result) {
            return [];
        }
        while($row = $this->result->fetch_assoc())
        {
            if(isset($row[$key]))
            {
                $data[$row[$key]] = $row;
            }
            else
            {
                $data[] = $row;
            }
        }
        return $data;
    }
    public function fetchColumn($colum_name,$key = false)
    {
        $data = array();
        while($row = $this->result->fetch_assoc())
        {
            if($key && isset($row[$key]))
            {
                $data[$row[$key]] = $row[$colum_name];
            }
            else
            {
                $data[] = $row[$colum_name];
            }
        }
        return $data;
    }      
    public function fetch()
    {
        if($this->result){
            return $this->result->fetch_assoc();
        } else {
            return [];
        }
    }
    public function getRow($column,$value)
    {
        return $this->fetch($this->query("SELECT * FROM {$this->table} WHERE {$column} = '{$value}'")->result);
    }
    public function select($column = NULL, $value = NULL, $field = 'id')
    {
        
        if($columns !== NULL){
            $columns = implode(",", $column);
        } else {
            $columns = "*";
        }
        if($value !== NULL && $this->where === NULL){
            $w = "WHERE {$field} = '{$value}'";
        } else {
            $w = $this->where;
        }
        return $this->query("SELECT {$columns} FROM {$this->table} {$w} {$this->limit} ")->fetchArray();
    }
    public function selectOne($column, $value = NULL, $field = 'id')
    {
        $columns = implode(",", $column);
        if($value !== NULL){
            $w = "WHERE {$field} = '{$value}'";
        }
        return $this->query("SELECT {$columns} FROM {$this->table} {$w} ")->fetch();
    }
    public function update($columns,$itemId)
    {
        $itemId+=0;
        $q = "UPDATE {$this->table} SET ";
        $tmp = array();
        foreach($columns as $k=>$v)
        {
            if(strtolower($v)!="null") {
                $tmp[] = "{$k} = '".addslashes($v)."'";
            } else {
                $tmp[] = "{$k} = {$v}";
            }
        }
        $q.= implode(", ", $tmp);
        $q.= " WHERE id = '{$itemId}' LIMIT 1";
        
        return $this->query($q)->result;
    }
    public function update2($columns,$whereStatement = "1")
    {
        $q = "UPDATE {$this->table} SET ";
        $tmp = array();
        foreach($columns as $k=>$v)
        {
            if(strtolower($v)!="null") {
                $tmp[] = "{$k} = '".addslashes($v)."'";
            } else {
                $tmp[] = "{$k} = {$v}";
            }
        }
        $q.= implode(", ", $tmp);
        $q.= " WHERE {$whereStatement} LIMIT 1";
        return $this->query($q)->result;
    }
    public function multiInsert($columns)
    {
        $q = "INSERT INTO {$this->table} ";
        $q.="(".implode(",", array_keys($columns[0])).")";
        $q.=" VALUES ";
        
        $sq = [];
        foreach($columns as &$cols) {
            
            foreach($cols as &$v) {
                if(strtolower($v)!="null") {
                    $v = "'".addslashes($v)."'";
                }
            }
        
            $sq[] = "(".implode(", ", array_values($cols)).")";
        }
        $q.= implode(", ", array_values($sq));
        
        return $this->query($q)->result;
    }
    public function insert($columns)
    {
        foreach($columns as $k => &$v) {
            if(strtolower($v)!="null") {
                $v = "'".addslashes($v)."'";
            }
        }
        
        $q = "INSERT INTO {$this->table} ";
        $q.="(".implode(",", array_keys($columns)).")";
        $q.=" VALUES ";
        $q.="(".implode(",", array_values($columns)).")";
        
        return $this->query($q)->result;
    }
    public function delete($value,$field='id')
    {
        $q = "DELETE FROM {$this->table} WHERE `{$field}` = '{$value}'";
        return $this->query($q)->result;
    }
    public function table($table)
    {
        $this->table = $table;
        return $this;
    }
    public function foundRows()
    {
        return $this->query('select FOUND_ROWS() as rowsCount')->fetchArray()[0]['rowsCount'];
    }
    public function num_rows()
    {
        return $this->result->num_rows;
    }
    public function affected_rows()
    {
        return $this->object->affected_rows;
    }
    public function affectedRows()
    {
        return $this->object->affected_rows;
    }
    public function insertedId()
    {
        return $this->object->insert_id;
    }
    public function disconnect()
    {
        $this->object->close();
        unset($this->object);
    }
    function __destruct()
    {
        $this->disconnect();
    }
    public function limit($limit, $startRow = 0) {
        $limit+=0;
        $startRow+=0;
        $this->limit = " LIMIT $startRow, $limit ";
        return $this;
    }
    public function where() {
        $this->where = " WHERE {$conditions} ";
        return $this;
    }
    private function confirm_query()
    {
        die("<div style='background-color:#fef1ec;border: 1px solid #CD0A0A;border-radius:4px;color: #CD0A0A;direction:ltr;font-family:sans-
            serif,Arial,verdana;font-size: 12px;padding:12px 7.7px'>
            <strong>SQL query failed: </strong><br />" . $this->lastQuery . "<br /><br />
            <strong>MySQL error report: </strong><br />" . $this->object->errno . '<br />' . $this->object->error . "
            </div>");
    }
}
