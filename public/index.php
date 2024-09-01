<?php

session_start();

require_once "../app/core/init.php"; 
require_once "../app/core/App.php"; 

DEBUG ? ini_set('display_errors', 1) : ini_set('display_errors', 0);

$app = new App();
$app->loadController();