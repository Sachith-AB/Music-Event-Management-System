<?php
    //start session
    session_start();

    // create constant to store non repeating value
    define("SITEURL","http://localhost/Event-Management-System/");
    define("LOCALHOST","localhost");
    define("DB_USERNAME","root");
    define("DB_PASSWORD","");
    define("DB_NAME","eventease");

    $conn = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_error($conn));
    $db_select = mysqli_select_db($conn,DB_NAME) or die(mysqli_error($conn));

    if($conn){
        echo'database connected';
    }else{
        echo "connection error";
    }
    

?>