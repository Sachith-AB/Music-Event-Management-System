<?php 
 class Ticket {

    use Controller;
     
    use Model;
    public function index(){
        echo "This is the ticket controllers";
        $this->view('ticket/purchaseticket');

    }
 }