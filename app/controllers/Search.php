<?php

class Search {

    use Controller;
    use Model;

    public function index(){

        $this->view('search');
    }
}