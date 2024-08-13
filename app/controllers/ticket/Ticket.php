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
}