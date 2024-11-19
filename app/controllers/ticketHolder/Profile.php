<?php

class Profile {

    use Controller;

    use Model;

    

    public function index(){

        $user = new User;

        $data = $this->profile($user);
        //show( $data);

        $id = $_SESSION['USER']->id ?? 0;
        $buyticket = new Buyticket();
        $mytickets = $buyticket->getAllPurchasedEvents($id);
        $ticket = new Ticket();
        $combinedTickets = [];
        foreach ($mytickets as $myticket) {
            $ticket_id = $myticket->ticket_id; 
            $eventDetail = $ticket->getTicketAndEventDetails($ticket_id); 
            $combinedTickets[] = array_merge((array)$myticket, (array)$eventDetail);
        }

        $this->view('ticketHolder/profile',['data'=>$data,'combinedTickets'=>$combinedTickets]);
        
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
}