<?php

trait Controller {

    // Check if user is logged in
    public function isLoggedIn($id) {
        echo $id;

        // If not logged in, redirect to signin page
        if ($id) {
            
            return true;
        }
        
    }
    public function view($file , $data = [], $requireLogin = false){

         // If the view requires login, check the session
        if ($requireLogin && !$this->isLoggedIn($data['id'])) {
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