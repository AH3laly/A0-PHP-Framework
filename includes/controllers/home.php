<?php
/*
* Author: Abdelrahman Helaly
* Contact: < AH3laly@gmail.com , https://Github.com/AH3laly >
* Project: A0 PHP Lightweight Framework (A0 for Abdo). 
* Description: Simple & Fast & Lightweight PHP Framework to quickly Create website.
* License: Science not for Monopoly.
*/

namespace controllers;

class home extends base {
    
    public static function action_home()
    {
        
        $data = [];
        $data["items"] = [
            "Item 1", 
            "Item 2", 
            "Item 3", 
            "Item 4", 
            "Item 5", 
            "Item 6", 
            "Item 7", 
            "Item 8", 
            "Item 9", 
            "Item 10"
        ];
        
        self::pageDisplay($data);
    }
}
