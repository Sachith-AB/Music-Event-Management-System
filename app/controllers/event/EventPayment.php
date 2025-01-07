<?php

class EventPayment {

    use Controller;
    use Model;

    public function index() {
        $data = [];
        $event = new Event;
        $payment = new Payment;
        $data1 = $this->getEventData($event);


        $event_id = htmlspecialchars($_GET['id']);
        $row = $event->firstById($event_id);

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
            //show($_POST);


           $this->addPayment($payment);


            
        } 

        $data2 = $this->totalPayment($payment,$event_id);
        //show($data2);

        $data = array_merge($data1,$data2);

        
        // Pass the event data to the view
        //$this->view('event/eventPayment', $data);
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
        //show($_POST);
       
       
        
    }

    public function totalPayment($payment, $id) {
        $total_payment = $payment->getPaymentData($id);
    
        $user_id = [];
        $total_cost = [];
        foreach ($total_payment as $record) {
            $user_id[] = $record->name; // Ensure valid user_id
            $total_cost[] = $record->total_payment; // Ensure valid total_payment
        }
    
        return ['total_cost' => $total_cost, 'user_id' => $user_id];
    }
    
    
}