<?php

spl_autoload_register(function($classname){
    require $fileName = "../app/models/".ucfirst($classname).".php";
});

require_once '../app/Provider/Router.php';
require 'config.php';
require 'functions.php';
require 'Database.php';
require 'Model.php';
require 'Controller.php';
require 'App.php';
require 'route.php';