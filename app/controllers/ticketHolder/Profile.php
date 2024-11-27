<?php

class Profile {

    use Controller;

    use Model;

    

    public function index(){

        $user = new User;

        $data = $this->profile($user);
        //show( $data);

        $combinedTickets=$this->purchasedetails();

        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['logOut'])){
            $this->logOut();
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

    public function purchasedetails(){

        $buyticket = new Buyticket();
        $ticket = new Ticket();

        $id = $_SESSION['USER']->id ?? 0;

        $mytickets = $buyticket->getAllPurchasedEvents($id);
        $combinedTickets = [];
        foreach ($mytickets as $myticket) {
            $ticket_id = $myticket->ticket_id; 
            $eventDetail = $ticket->getTicketAndEventDetails($ticket_id); 
            $combinedTickets[] = array_merge((array)$myticket, (array)$eventDetail);
        }
        return $combinedTickets;

    }

    private function logOut(){
        session_unset(); // Unset all session variables
        session_destroy(); // Destroy the session
    }
}