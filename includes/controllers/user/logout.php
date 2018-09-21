<?php
/*
* Author: Abdelrahman Mohamed
* Contact: < Abdo.Tasks@Gmail.Com , https://Github.com/abd0m0hamed >
* Project: A0 PHP Lightweight Framework (A0 for Abdo). 
* Description: Simple & Fast & Lightweight PHP Framework to quickly Create website.
* License: Science not for Monopoly.
*/

namespace Controllers\user;

class logout 
{
    public static function action_home()
    {
        A0()->user->logout();
        A0()->output->redirect(URI_index."user/login");
    }
}
