<?php
/*
* Author: Abdelrahman Mohamed
* Contact: < Abdo.Tasks@Gmail.Com , https://Github.com/abd0m0hamed >
* Project: A0 PHP Lightweight Framework (A0 for Abdo). 
* Description: Simple & Fast & Lightweight PHP Framework to quickly Create website.
* License: Science not for Monopoly.
*/

namespace A0;

class router
{
    public $controller = NULL;
    public $class = NULL;
    private $defaultClass = "action_home";
    private $defaultController = "home.php";
    private $parameters = array();
    public $method = NULL;
    public function __construct()
    {
        $pathLevels = explode("/", trim($_SERVER['PATH_INFO'],"/"));
        $pathLevels = array_filter($pathLevels);
        $level = "controllers";
        $this->controller = "{$level}/".$this->defaultController;
        $includesFolder = rtrim(FOLDER_includes,"/");
        foreach($pathLevels as $k => $lvl)
        {
            $level .= "/{$lvl}";
            if(is_file(FOLDER_includes.$level))
            {
                $this->controller = $level;
                $this->parameters = array_slice($pathLevels, $k+1);
                break;
            }     
            else if(is_file(FOLDER_includes.$level.".php"))
            {
                $this->controller = $level.".php";
                $this->parameters = array_slice($pathLevels, $k+1);
                break;
            } else if(is_file(FOLDER_includes.$level."/home.php")) {
                $this->controller = $level."/home.php";
                $this->parameters = array_slice($pathLevels, $k+1);
            }
        }
        $this->class = strstr(str_replace("/", "\\", $this->controller),".",true);
        $this->method = ($this->parameters[0]) ? "action_{$this->parameters[0]}" : "action_home";
    }
    public function route()
    {
        if(file_exists(FOLDER_includes.$this->controller))
        {
            require_once(FOLDER_includes.$this->controller);
        }
        else
        {
            die('Invalid Controller ;)');
        }
        
        $reflectionClass = new \ReflectionClass($this->class);
        
        if($reflectionClass->hasMethod($this->method))
        {
            $reflectionMethod = new \ReflectionMethod($this->class,  $this->method);
            $reflectionMethod->invoke(new $this->class(),  $this->parameters);
            
        } else if ($reflectionClass->hasMethod("action_home")) {
        
            $reflectionMethod = new \ReflectionMethod($this->class,  "action_home");
            $reflectionMethod->invoke(new $this->class(),  $this->parameters);
            
        } else {
        
            die("Invalid Method");
        }
    }
}
