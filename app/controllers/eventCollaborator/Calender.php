<?php

class Calender {
    use Controller;

    public function index(){

        $requst = new Request;
        $id = $_SESSION['USER']->id;
        $data = [];
        $data = $this->getAccepetdEvent($id,$requst);
        // show($data);
        $this->view('eventCollaborator/calender',$data);
        
    }

    private function getAccepetdEvent($id , $requst){
        $res = $requst->getAcceptedEvents($id);
        return $res;
    }
}