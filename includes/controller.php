<?php
/*
* Author: Abdelrahman Mohamed
* Contact: < Abdo.Tasks@Gmail.Com , https://Github.com/abd0m0hamed >
* Project: A0 PHP Lightweight Framework (A0 for Abdo). 
* Description: Simple & Fast & Lightweight PHP Framework to quickly Create website.
* License: Science not for Monopoly.
*/

define("URI_index", "http://localhost/A0PHPFramework/");
define("Default_theme", "default");
define("Maintenance_Mode", false);
ini_set('display_errors', "off");
ini_set('error_reporting', E_ALL);
ini_set("memory_limit", "1024M");
date_default_timezone_set("Africa/Cairo");
ini_set('session.cookie_lifetime', 86400);
ini_set('session.gc_maxlifetime',86400);

session_start();

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

$startupTime = microtime(true);

if(isset($_REQUEST["debug"])){
    ini_set('display_errors', "on");
}

if(Maintenance_Mode)
{
    echo "<div style='margin: auto; padding: 10px; background-color:#000; text-align:center;'><img src='".URI_index."assets/img/maintenance.jpg'/></div>";
    exit;
}

//Handling autoload
spl_autoload_register(function($class)
{
    $classPath = FOLDER_includes . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
    if(file_exists($classPath))
    {
        require_once($classPath);
    }
});

$A0 = new \A0\core();
$A0->config = require_once 'config.php';
$A0->db->connect($A0->config['database']['username'], $A0->config['database']['password'],$A0->config['database']['name'],$A0->config['database']['host']);

function A0()
{
    global $A0;
    return $A0;
}

set_error_handler(function($errno,$errstr,$errfile,$errline,$errcontext){
    if(A0()->config['debug'])
    {
        A0()->__errors[] = "<b>errNo:</b> {$errno} , <b>errStr:</b> {$errstr} , <b>errFile:</b> {$errfile} , <b>errLine:</b> {$errline}";
    }
});

register_shutdown_function(function(){
    if(A0()->config['debug'])
    {
        if(count(A0()->__errors)>0)
        {
            echo "<div style='padding:10px;margin: 20px 5px; background-color:rgba(255, 203, 203, 0.5); border-radius:5px;'>";
            A0()->__errors[] =  error_get_last();
            echo implode("<br /><br />", A0()->__errors);
            echo "</div>";
        }
    }
});

require_once("helpers.php");

A0()->secureRequest();

//Initiate Template Processor
A0()->template = new \libraries\template();
A0()->template->left_delimiter = "{!"; 
A0()->template->right_delimiter = "!}";
A0()->template->setTemplateDir(FOLDER_templates);
A0()->template->setCacheDir(FOLDER_includes."data/cached");
A0()->template->setCompileDir(FOLDER_includes."data/compiled");

A0()->user = new \models\user();

A0()->email = new \libraries\email();
A0()->__messages = A0()->session->get('messages');

startUp();


A0()->template->assign('A0',(object)["session"=>A0()->session,"user"=>A0()->user]);
try {
A0()->router->route();
} catch (Exception $e){
    A0()->response->setError(1)->setContent(0)->setMessage($e->getMessage()." : ".$e->getCode(),"danger")->send();
}

require_once('shutdown.php');
