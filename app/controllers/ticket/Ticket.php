<?php

class Ticket {

    use Controller;
    use Model;
    public function index() {

        $this->view('ticket/purchaseticket');
        
       
    }


    public function index2() {

        $this->view('ticket/successfullypaid');
       
    }


    public function index3() {

        $this->view('ticket/upcommingevent');
       
    }

    public function index4() {

        $this->view('ticket/ticketholder_event');
       
    }
}