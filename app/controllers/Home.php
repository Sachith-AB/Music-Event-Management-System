<?php 
 class Home {

    use Controller;
     
    use Model;
    public function index(){

        $user = new User;
        //echo "This is the home controllers";
        $this->view('home');


    }
 }

 