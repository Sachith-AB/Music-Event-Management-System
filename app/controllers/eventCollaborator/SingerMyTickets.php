<?php

use Dom\Notation;

class SingerMyTickets {

    use Controller;

    use Model;

    

    public function index(){



        $tickets=$this->purchasedetails();
        
        $upcomingTickets = $tickets['upcoming'];
        $pastTickets = $tickets['past'];
        


        $this->view('eventCollaborator/singerMytickets',['upcomingTickets'=>$upcomingTickets,'pastTickets'=>$pastTickets]);
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


}