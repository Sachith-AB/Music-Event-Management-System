<?php 

class Signin {

    use Controller;
    use Model;

    public function index() {
        $this->view('signin');
    }
}