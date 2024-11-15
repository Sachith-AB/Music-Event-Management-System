<?php

trait Controller {

    // Check if user is logged in by verifying session
    public function isLoggedIn() {
        // Start session if not already started
        if (session_status() === PHP_SESSION_NONE) {
            session_start();

        }

        // Check if session exists
        if (isset($_SESSION['USER'])) {
            // Check if the session has expired (1 hour = 3600 seconds)
            if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 60)) {
                // If more than 1 hour has passed, destroy the session
                session_unset();    // Unset session variables
                session_destroy();  // Destroy the session
                
                // Redirect to the login page
                redirect('home');
                exit();
            }

            // Update last activity time
            $_SESSION['LAST_ACTIVITY'] = time(); // Reset the session timer

            return true; // User is logged in
        }

        // Check if the session has a user logged in
        return isset($_SESSION['USER']);
    }
    public function view($file , $data = [], $requireLogin = true){

         // If the view requires login, check the session
        if ($requireLogin && !$this->isLoggedIn()) {
            // Redirect to the login page if the user is not logged in
            redirect("home");
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