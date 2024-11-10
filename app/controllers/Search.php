<?php

class Search {

    use Controller;
    use Model;
    
    public function index(){

        $event = new Event;
        $data = [];

        $data = $this->getEvents($event);

        $this->view('search',$data);
    }

    public function getEvents($event){
        $res = $event->findAll();
        return $res;
    }
}