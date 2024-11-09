<?php

class BandRequest {

    use Controller;
    
    public function index(){

        $this->view('request/bandsRequest');
    }
}