<?php
/*
* Author: Abdelrahman Helaly
* Contact: < AH3laly@gmail.com , https://Github.com/AH3laly >
* Project: A0 PHP Lightweight Framework (A0 for Abdo). 
* Description: Simple & Fast & Lightweight PHP Framework to quickly Create website.
* License: Science not for Monopoly.
*/

namespace controllers\api;

class apiauth {

    public static function action_home($args = [])
    {
    
        if(!A0()->user->isActive()){
        
            A0()->response
                ->setError(1)
                ->setMessage("Access Denied",'error')
                ->setContent(["No Content Loaded"])
                ->send();
        }
        
        //If Authenticated Code Here
        
        
    }
}
