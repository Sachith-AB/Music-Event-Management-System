<?php

spl_autoload_register(function($classname){
     $file= __DIR__. "../app/models/". $classname . '.php';
     if(file_exists($file)){
         require $file;
     }
});

require_once '../app/Provider/Router.php';
require 'config.php';
require 'functions.php';
require 'Database.php';
require 'Model.php';
require 'Controller.php';
require 'App.php';
require 'route.php';