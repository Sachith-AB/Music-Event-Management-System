<?php

use Dom\Notation;

class Profile {

    use Controller;

    use Model;

    

    public function index(){

        $user = new User;
        $notification = new Notification;

        $data = $this->profile($user);
        // show( $data);

        $tickets=$this->purchasedetails();
        $upcomingTickets = $tickets['upcoming'];
        $pastTickets = $tickets['past'];
        $ticketcount = $this->getticketcount(array_merge($upcomingTickets,$pastTickets));
        // $notifications = $this->getnotifications($data['id']);
        // if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['changeread'])){
        //     $notification->markasread($data['id']);
        // }
        
        //  show($combinedTickets);

        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['logOut'])){
            $this->logOut();
        }

        

        $this->view('ticketHolder/profile',['data'=>$data,'upcomingTickets'=>$upcomingTickets,'pastTickets'=>$pastTickets,'ticketcount'=>$ticketcount]);
        
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
        $notification = new Notification;

        $id = $_SESSION['USER']->id ?? 0;

        $mytickets = $buyticket->getAllPurchasedEvents($id);
        $upcomingTickets = [];
        $pastTickets = [];
        foreach ($mytickets as $myticket) {
            $ticket_id = $myticket->ticket_id; 
            $eventDetail = $ticket->getTicketAndEventDetails($ticket_id); 
            
            show($eventDetail);
            if($eventDetail && isset($eventDetail[0]->event_date)){
                // $notifications = $notification->getNotifications($eventDetail[0]->event_id);
        
                $combined = array_merge((array)$myticket, (array)$eventDetail);

                $eventDate = $eventDetail[0]->event_date;
                // show($eventDetail);
            if (strtotime($eventDate) >= strtotime(date('Y-m-d'))) {
                $upcomingTickets[] = $combined;
            } else {
                $pastTickets[] = $combined;
            }
            }

            
        }
         
        return ['upcoming'=>$upcomingTickets,'past'=>$pastTickets];

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
    // public function getnotifications($user_id){
    //     $notification = new Notification;
    //     $notifymsg = [];
    //     $newnotifymsg = $notification->getNewnotifications($user_id);
    //     $allnotifymsg = $notification->getNotifications($user_id);
    //     $notifymsg["newnotifications"] = $newnotifymsg;
    //     $notifymsg["allnotifications"] = $allnotifymsg;
    //     return $notifymsg;
    
}