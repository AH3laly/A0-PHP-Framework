<?php
/*
* Author: Abdelrahman Mohamed
* Contact: < Abdo.Tasks@Gmail.Com , https://Github.com/abd0m0hamed >
* Project: A0 PHP Lightweight Framework (A0 for Abdo). 
* Description: Simple & Fast & Lightweight PHP Framework to quickly Create website.
* License: Science not for Monopoly.
*/

namespace controllers\api;

class customer {
    
    public static function action_home($args = [])
    {
        
        // $args[0] = Parameter 1
        // $args[1] = Parameter 2
        
        $data = [
            "name"=>"Abdelrahman Mohamed",
            "github"=>"https://github.com/abd0m0hamed",
            "email"=>"Abdo.Tasks@Gmail.com"
        ];
        
        $customerObject = new \models\customer();
        
        switch($args[0]){
        
            // api/customer/create
            case 'create':
                A0()->response
                ->setError(1)
                ->setMessage("User Created.",'success')
                ->setContent($customerObject->create($data))
                ->send();
            break;
            
            // api/customer/update/1
            case 'update':
                A0()->response
                ->setError(1)
                ->setMessage("User Updated.",'success')
                ->setContent($customerObject->update($data,$args[1]))
                ->send();
            break;
            
            // api/customer/get/1
            case 'get':
                A0()->response
                ->setError(1)
                ->setMessage("User Info Loaded.",'success')
                ->setContent($customerObject->load($args[1]))
                ->send();
            break;
            
            // api/customer/delete/1
            case 'delete':
                A0()->response
                ->setError(1)
                ->setMessage("User Deleted.",'success')
                ->setContent($customerObject->delete($args[1]))
                ->send();
            break;
            
        }
        
    }
}
