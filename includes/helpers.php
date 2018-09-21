<?php
/*
* Author: Abdelrahman Mohamed
* Contact: < Abdo.Tasks@Gmail.Com , https://Github.com/abd0m0hamed >
* Project: A0 PHP Lightweight Framework (A0 for Abdo). 
* Description: Simple & Fast & Lightweight PHP Framework to quickly Create website.
* License: Science not for Monopoly.
*/

function startUp()
{
    //Startup code Here
}
function generateRandom($useSymbols = false)
{
    $length = 10;
    $chars = [];
    $chars[] = 'abcdefghijklmnopqrstuvwxyz';
    $chars[] = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $chars[] = '0123456789';
    
    if($useSymbols) {
        $chars[] = ']!@&*()-+=}{][';
    }
    
    $token = "";
    for($i=0;$i<=$length;$i++) {
        foreach($chars as $v) {
            $sl = strlen($v)-1;
            $token .= $v[rand(0,$sl)];
        }
    }
    return $token;
}

