<?php
/*
* Author: Abdelrahman Mohamed
* Contact: < Abdo.Tasks@Gmail.Com , https://Github.com/abd0m0hamed >
* Project: A0 PHP Lightweight Framework (A0 for Abdo). 
* Description: Simple & Fast & Lightweight PHP Framework to quickly Create website.
* License: Science not for Monopoly.
*/

return [
        'database' =>
        [
            'host'=>"localhost",
            'username'=>"root",
            'password'=>'123456',
            'name'=>"website",
            'debug'=>false
        ],
        'email'=>
        [
            'host'=>'smtp.domain.com',
            'port'=>'465',
            'from'=>'noreply@domain.com',
            'username'=>'noreply@domain.com',
            'password'=>'SmtpPassword',
            'enabled'=>true
        ],
        'security'=>
        [
            //Change this to something very complex use php -f commands/genkey.php to generate Random.
            'encryption_token'=>'dS6sV6lE7iV5lE4nC0kP2cT8wD3wP9hY0bI8bW0yX2bN2aO3wO5fS7cK4sA3oS5wB2yI0fH9fN7yG4xW2nN7zK0uB3gZ2'
        ],
        'theme'=>'abdo',
        'debug'=>false
    ];
