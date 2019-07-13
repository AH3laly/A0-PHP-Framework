<?php
/*
* Author: Abdelrahman Helaly
* Contact: < AH3laly@gmail.com , https://Github.com/AH3laly >
* Project: A0 PHP Lightweight Framework (A0 for Abdo). 
* Description: Simple & Fast & Lightweight PHP Framework to quickly Create website.
* License: Science not for Monopoly.
*/

namespace A0;

DEFINE("A0_ROOT",__DIR__);

class core {
    
    public $config = [];
    public function __construct() {
        
        $this->__page = ($_REQUEST['page']+0) ? $_REQUEST['page']+0 : 1;
        $this->__order = ($_REQUEST['order'] == "asc") ? "ASC" : "DESC";
        $this->__limit = 30;
        $this->__offset = ($this->__limit) * ($this->__page -1);
        $this->__errors = [];
        
        $this->db = new \A0\models\databasei();
        $this->router = new \A0\router();
        $this->output = new \A0\models\output();
        $this->response = new \A0\models\response();
        $this->session = new \A0\models\session();
    }
    
    public function paginate($itemsCount) {
        
        $pagesInBar = 10;
        $barsCount = ceil($itemsCount/$this->__limit);
        
        if($barsCount <= 1){
            return [];
        }
        
        $currentBar = $this->__page / $pagesInBar;
        $lastPage = ceil($itemsCount / $this->__limit);
        
        
        if($this->__page > $lastPage || $this->__page < 1 ){
            return [];
        }

        if($currentBar > $barsCount){
            $currentBar = $barsCount;
        }
        
        if(is_int($currentBar)){
            $currentBar-= 0.5;
        }
        
        $barFirstPage = $pagesInBar * floor($currentBar)+1;
        $barLastPage = $pagesInBar * ceil($currentBar);

        $data = [];
        
        for($p = $barFirstPage; $p <= $barLastPage; $p++){
            if($p <= $lastPage){
                $data[$p] = $p;
            }
        }
        
        $prevBarLastPage = $barFirstPage-1;
        if($prevBarLastPage) {
            $data[$prevBarLastPage] = $prevBarLastPage;
        }
        
        
        $nextBarFirstPage = $barLastPage+1;
        if($nextBarFirstPage <= $lastPage) {
            $data[$nextBarFirstPage] = $nextBarFirstPage;
        }
        
        //Add Last Page Button
        if($prevBarLastPage>1) {
            $data[1] = "1";
        }
        
        //Add Last Page Button
        if($lastPage>$nextBarFirstPage) {
            $data[$lastPage] = $lastPage;
        }
        return $data;
    }
    
    function secureRequest()
    {
        $_POST      = $this->encode($_POST);
        $_GET       = $this->encode($_GET);
        $_REQUEST   = $this->encode($_REQUEST);
    }
    
    function decode($string)
    {
        $from = array("&lt;", "&gt;", "&quot;", "&apos;", "&#92;");
        $to = array("<", ">", "\"", "'", "\\");
        if(!is_array($string))
        {
            $string = str_replace($from, $to, trim($string));
        }
        else
        {
            array_walk_recursive($string, function(&$v,$k,$params){
                $v = str_replace($params[0], $params[1], trim($v));
            },[$from,$to]);
        }
        return $string;
    }
    
    function encode($string)
    {
        $from = array("<", ">", "\"", "'", "\\", "]]>");
        $to = array("&lt;", "&gt;", "&quot;", "&apos;", "&#92;", "]&#93;>");
        if(!is_array($string))
        {
            $string = str_replace($from, $to, trim($string));
        }
        else
        {
            array_walk_recursive($string, function(&$v,$k,$params){
                $v = str_replace($params[0], $params[1], trim($v));
            },[$from,$to]);
        }
        return $string;
    }
    
    function htmlOptions($options)
    {
        $HTML = "";
        foreach($options as $k=>$v)
        {     
            $HTML .= "<option value='{$k}'>{$v}</option>";
        }
        return $HTML;
    }
    
}
