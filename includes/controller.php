<?php
/*
* Author: Abdelrahman Helaly
* Contact: < AH3laly@gmail.com , https://Github.com/AH3laly >
* Project: A0 PHP Lightweight Framework (A0 for Abdo). 
* Description: Simple & Fast & Lightweight PHP Framework to quickly Create website.
* License: Science not for Monopoly.
*/

session_start();
$startupTime = microtime(true);

$config = require_once 'config.php';

if(DEBUG_MODE && isset($_REQUEST["debug"])){
    ini_set('display_errors', "on");
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
function A0()
{
    global $A0;
    return $A0;
}

A0()->config = $config;
unset($config);

A0()->db->connect($A0->config['database']['username'], $A0->config['database']['password'],$A0->config['database']['name'],$A0->config['database']['host']);

set_error_handler(function($errno,$errstr,$errfile,$errline,$errcontext){
    if(DEBUG_MODE)
    {
        A0()->__errors[] = "<b>errNo:</b> {$errno} , <b>errStr:</b> {$errstr} , <b>errFile:</b> {$errfile} , <b>errLine:</b> {$errline}";
    }
});

register_shutdown_function(function(){
    if(DEBUG_MODE)
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

if(Maintenance_Mode)
{
    echo "<div style='margin: auto; padding: 10px; background-color:#000; text-align:center;'><img src='".URI_index."assets/img/maintenance.jpg'/></div>";
    exit;
}

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
