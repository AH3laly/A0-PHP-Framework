<?php
/*
* Author: Abdelrahman Mohamed
* Contact: < Abdo.Tasks@Gmail.Com , https://Github.com/abd0m0hamed >
* Project: A0 PHP Lightweight Framework (A0 for Abdo). 
* Description: Simple & Fast & Lightweight PHP Framework to quickly Create website.
* License: Science not for Monopoly.
*/

namespace A0\models;

class session
{
    public $holder = "A0Session";
    
    public function get($key)
    {
        return $_SESSION[$this->holder]["$key"];
    }
    
    public function set($key,$value)
    {
        $_SESSION[$this->holder]["$key"]=$value;
    }
    
    public function sets($data)
    {
        foreach($data as $k => $v)
            $_SESSION[$this->holder][$k] = $v;
    }
    
    public function remove($key)
    {
        unset($_SESSION[$this->holder][$key]);
    }
    
    public function destroy()
    {
        $_SESSION[$this->holder] = [];
    }
    
}
