<?php 
 class Home {

    use Controller;
     
    use Model;
    public function index(){
        //echo "This is the home controllers";
        $this->view('home');

    }
 }

 