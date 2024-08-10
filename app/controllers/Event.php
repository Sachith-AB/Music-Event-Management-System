<?php

class Event extends Controller {
    public function index(){
        echo "this is event controller";

        $this->view('event');
    }
}