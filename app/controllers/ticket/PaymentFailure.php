<?php 
class PaymentFailure{

    use Controller;
    use Model;

    public function index(){

        $data =[];
        $event = new Event;
        $data = $this->getEventData($event);
        // show($data);

        $this->view('ticket/paymentFailure',$data);
       
    }

    public function getEventData($event){
        $id = htmlspecialchars($_GET['id']);
        $res = $event->getAllEventData($id);
        return $res;
    }
}