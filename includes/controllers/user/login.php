<?php
/*
* Author: Abdelrahman Helaly
* Contact: < AH3laly@gmail.com , https://Github.com/AH3laly >
* Project: A0 PHP Lightweight Framework (A0 for Abdo). 
* Description: Simple & Fast & Lightweight PHP Framework to quickly Create website.
* License: Science not for Monopoly.
*/

namespace controllers\user;

class login
{
    public static function action_home()
    {
        A0()->output->plain("Please Login.");
        //A0()->output->redirect("http://loginurl");
        
    }
    public static function action_processlogin()
    {
        
    }

}
