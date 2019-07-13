<?php
/*
* Author: Abdelrahman Helaly
* Contact: < AH3laly@gmail.com , https://Github.com/AH3laly >
* Project: A0 PHP Lightweight Framework (A0 for Abdo). 
* Description: Simple & Fast & Lightweight PHP Framework to quickly Create website.
* License: Science not for Monopoly.
*/

date_default_timezone_set("Africa/Cairo");
ini_set('display_errors', "off");
ini_set('error_reporting', E_ALL);
ini_set("memory_limit", "1024M");
ini_set('session.cookie_lifetime', 86400);
ini_set('session.gc_maxlifetime',86400);

define("DEBUG_MODE", 0);
define("URI_index", "http://localhost/A0PHPFramework/");
define("Default_theme", "default");
define("Maintenance_Mode", false);
define("URI_upload", URI_index . "upload/");
define("URI_theme", URI_index."themes/".Default_theme."/");
define("FOLDER_includes", __DIR__ . "/");
define("FOLDER_root", FOLDER_includes . "../");
define("FOLDER_themes", FOLDER_root . "themes"."/".Default_theme."/");
define("FOLDER_templates", FOLDER_includes . "templates/");
define("FOLDER_journalExports", FOLDER_root . "journalExports/");
define("FOLDER_upload", FOLDER_root . "upload/");
define("FOLDER_uploadOld",FOLDER_root."../databox/upload/");
define("FOLDER_images", FOLDER_root."images/");
define("MESSAGE_info", "info");
define("MESSAGE_confirm", "confirm");
define("MESSAGE_warning", "warning");
define("MESSAGE_error", "error");
define("CONSTANT_MAX_AD_IMAGES", 10);
define('UTF32_BIG_ENDIAN_BOM'   , chr(0x00) . chr(0x00) . chr(0xFE) . chr(0xFF));
define('UTF32_LITTLE_ENDIAN_BOM', chr(0xFF) . chr(0xFE) . chr(0x00) . chr(0x00));
define('UTF16_BIG_ENDIAN_BOM'   , chr(0xFE) . chr(0xFF));
define('UTF16_LITTLE_ENDIAN_BOM', chr(0xFF) . chr(0xFE));
define('UTF8_BOM'               , chr(0xEF) . chr(0xBB) . chr(0xBF));

return [
        'database' =>
        [
            'host'=>"localhost",
            'username'=>"root",
            'password'=>'123456',
            'name'=>"website"
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
        'theme'=>'abdo'
    ];
