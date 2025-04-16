<?php

spl_autoload_register(function ($classname) {
    // Handle PHPMailer namespace
    if (strpos($classname, 'PHPMailer\\') === 0) {
        $classname = str_replace('\\', '/', $classname);
        require "../app/controllers/ticket/phpmailer/src/" . str_replace('PHPMailer/', '', $classname) . ".php";
        return;
    }
    
    // Handle other classes
    require "../app/models/" . ucfirst($classname) . ".php";
});

require_once '../app/Provider/Router.php';
require 'config.php';
require 'functions.php';
require 'Database.php';
require 'Model.php';
require 'Controller.php';
require 'App.php';
require 'route.php';