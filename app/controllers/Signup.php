<?php 

class Signup {
    
    use Controller;
    use Model;

    public function index() {
        $this->view('signup');
    }
}