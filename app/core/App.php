<?php
function splitUrl(){
    $URL = $_GET['url'] ?? 'home';
    $URL = explode("/", $URL);
    return $URL;
}

function loadController(){
    $URL = splitUrl();
    $fileName = "../app/controllers/".ucfirst($URL[0]).".php";
    if(file_exists($fileName)){
        require $fileName;
    }else{
        $fileName = "../app/controllers/_404.php";
        require $fileName;
    }
}