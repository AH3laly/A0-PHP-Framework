<?php
/*
* Author: Abdelrahman Helaly
* Contact: < AH3laly@gmail.com , https://Github.com/AH3laly >
* Project: A0 PHP Lightweight Framework (A0 for Abdo). 
* Description: Simple & Fast & Lightweight PHP Framework to quickly Create website.
* License: Science not for Monopoly.
*/

namespace controllers;

class base
{
    public static function pageDisplay($data = []){
        A0()->template->assign("data",$data);
        A0()->template->display('home.tpl');
    }
}
