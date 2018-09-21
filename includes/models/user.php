<?php
/*
* Author: Abdelrahman Mohamed
* Contact: < Abdo.Tasks@Gmail.Com , https://Github.com/abd0m0hamed >
* Project: A0 PHP Lightweight Framework (A0 for Abdo). 
* Description: Simple & Fast & Lightweight PHP Framework to quickly Create website.
* License: Science not for Monopoly.
*/

namespace models;

class user
{
    private $data = array();
    
    public function isActive()
    {
        //Write Logic here
        return false;
    }
    
    public function logout()
    {
        A0()->session->destroy();
    }
    
    public function login($username,$password)
    {
        //Login logic here
    }
}
