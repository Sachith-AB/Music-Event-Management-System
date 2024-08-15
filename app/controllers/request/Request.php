<?php 

class Request {

    use Controller;

    public function index() {

        $this->view('request/request');
    }
}