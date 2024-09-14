<?php

trait Controller {

    // Check if user is logged in by verifying session
    public function isLoggedIn() {
        // Start session if not already started
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Check if the session has a user logged in
        return isset($_SESSION['USER']);
    }
    public function view($file , $data = [], $requireLogin = true){

         // If the view requires login, check the session
        if ($requireLogin && !$this->isLoggedIn()) {
            // Redirect to the login page if the user is not logged in
            redirect("signin");
            exit;
        }


        if(!empty($data)){
            extract($data);
        }
        
        $fileName = "../app/views/".$file.".view.php";
        if(file_exists($fileName)){
            require $fileName;
        }else{
            $fileName = "../app/views/404.view.php";
            require $fileName;
        }
    }
}