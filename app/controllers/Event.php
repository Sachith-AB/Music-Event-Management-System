<?php

class Event {

    use Controller;
    public function index(){
        echo "this is event controller";

        $this->view('event');
    }
}