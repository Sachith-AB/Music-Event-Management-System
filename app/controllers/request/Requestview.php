<?php 

class Requestview {

    use Controller;
    use Model;

    public function index()
    {
        $this->view('request/request');

    }

   
}