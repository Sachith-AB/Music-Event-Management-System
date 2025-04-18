<?php

class Search {

    use Controller;
    use Model;
    
    public function index(){

        $event = new Event;
        $data = [];

        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['searchEvents'])){

            $data = $this->searchEventByName($event);
            // show($data);
        }else if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['apply'])){
            $data = $this->filterEvents($event);
        }else{
            $data = $this->getEvents($event);
        }
        
        
        $this->view('search',$data);
    }

    public function getEvents($event){
        $res = $event->findAll();
        return $res;
    }

    public function searchEventByName($event){

        $res = $event->searchEventByName($_POST);
        //show($res);
        unset($_POST['name']);
        unset($_POST['location']);
        unset($_POST['search']);
        return $res;
    }

    public function filterEvents($event){
        $res = $event->filterEvents($_POST);
        return $res;
    }
}