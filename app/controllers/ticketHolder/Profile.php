<?php

class Profile {

    use Controller;

    use Model;

    

    public function index(){

        $user = new User;

        $data = $this->profile($user);
        //show( $data);

        $combinedTickets=$this->purchasedetails();

        $ticketcount = $this->getticketcount($combinedTickets);

        //  show($combinedTickets);

        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['logOut'])){
            $this->logOut();
        }

        

        $this->view('ticketHolder/profile',['data'=>$data,'combinedTickets'=>$combinedTickets,'ticketcount'=>$ticketcount]);
        
    }

    public function profile($user){

        $id = $_SESSION['USER']->id ?? 0;
        //echo $id;

        $row = $user->firstById($id);
        $data = json_decode(json_encode($row),true);
        $_SESSION['USER'] = $row;
        //show($data) ;


        return $data;
        //show($row);
    }

    public function purchasedetails(){

        $buyticket = new Buyticket();
        $ticket = new Ticket();

        $id = $_SESSION['USER']->id ?? 0;

        $mytickets = $buyticket->getAllPurchasedEvents($id);
        $upcomingTickets = [];
        $pastTickets = [];
        foreach ($mytickets as $myticket) {
            $ticket_id = $myticket->ticket_id; 
            $eventDetail = $ticket->getTicketAndEventDetails($ticket_id); 

            if($eventDetail && isset($eventDetail->event_date)){
                $combined = array_merge((array)$myticket, (array)$eventDetail);

                $eventDate = $eventDetail[0]->event_date;
            if (strtotime($eventDate) >= strtotime(date('Y-m-d'))) {
                $upcomingTickets[] = $combined;
            } else {
                $pastTickets[] = $combined;
            }
            }

            
        }
         
        return $upcomingTickets;

    }

    private function logOut(){
        session_unset(); // Unset all session variables
        session_destroy(); // Destroy the session
    }

    public function getticketcount($combinedTickets){

        $totalPurchase = 0;
        $uniqueEvents = [];
        $totalPrice = 0;
        foreach($combinedTickets as $event){
            $totalPurchase += $event['ticket_quantity'];
            $uniqueEvents[$event[0]->event_id] = true;
            $totalPrice += $event['ticket_quantity'] * $event[0]->ticket_price;
        }
        $totalEvents = count($uniqueEvents);

        return [$totalEvents,$totalPurchase, $totalPrice];
    }
}