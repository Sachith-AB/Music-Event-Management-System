<?php

class EventPayment {

    use Controller;
    use Model;

    public function index() {
        $data = [];
        $event = new Event;
        $payment = new Payment;
        $data = $this->getEventData($event);



        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
            //show($_POST);


           $this->addPayment($payment);


            
        } 

        
        // Pass the event data to the view
        $this->view('event/eventPayment', $data);


        

    }

    public function getEventData($event) {
        $id = htmlspecialchars($_GET['id']);
        $res = $event->getAllEventData($id);
        //show($res);
        return $res;

    }

    public function addPayment($payment) {
        $id = htmlspecialchars($_GET['id']);
        $_POST['event_id'] = $id;
        $payment->insert($_POST);
       
        
    }
    
}
