<?php
/*
* Author: Abdelrahman Mohamed
* Contact: < Abdo.Tasks@Gmail.Com , https://Github.com/abd0m0hamed >
* Project: A0 PHP Lightweight Framework (A0 for Abdo). 
* Description: Simple & Fast & Lightweight PHP Framework to quickly Create website.
* License: Science not for Monopoly.
*/

namespace A0\models;

class output {
    
    public function __construct() {
        
    }
    
    public function json($data) {
        ob_clean();
        echo json_encode($data);
        return true;
    }
    
    public function plain($data) {
        ob_clean();
        echo $data;
        return true;
    }
    
     public function csv($data,$headers = [],$fileName = "DataboxCSVExportFile") {
        
        $fileName.= "_".date("Y-m-d_H-i");
        
        $obj = new \models\export();
        
        $obj->toExcel($data,"array",[],$fileName);
        
    }
    
    public function xml() {
    
    }
    public function redirect($url) {
        ob_start();
        ob_clean();
        header("location: {$url}");
        exit;
    }
    public function goback() {
    
    }
}
