<?php 

class ViewTicketHolder {

    use Controller;
    use Model;

    public function index() {
        $user = new User;
        $userId = htmlspecialchars($_GET['id']);
        $data = $this->profile($user,$userId);
        $tickets=$this->purchasedetails($userId);
        $upcomingTickets = $tickets['upcoming'];
        $pastTickets = $tickets['past'];
        $ticketcount = $this->getticketcount(array_merge($upcomingTickets,$pastTickets));

        $this->view('admin/viewticketholder',['data'=>$data,'upcomingTickets'=>$upcomingTickets,'pastTickets'=>$pastTickets,'ticketcount'=>$ticketcount]);

    }

    public function profile($user,$userId){


        $row = $user->firstById($userId);
        $data = json_decode(json_encode($row),true);
        
        //show($data) ;


        return $data;
    }   
    public function purchasedetails($id){

        $buyticket = new Buyticket();
        $ticket = new Ticket();
        


        $mytickets = $buyticket->getAllPurchasedEvents($id);
        $upcomingTickets = [];
        $pastTickets = [];
        foreach ($mytickets as $myticket) {
            $ticket_id = $myticket->ticket_id; 
            $eventDetail = $ticket->getTicketAndEventDetails($ticket_id); 
            if($eventDetail && isset($eventDetail[0]->event_date)){
                
                $combined = array_merge((array)$myticket, (array)$eventDetail);
                $eventDate = $eventDetail[0]->event_date;
               
            if (strtotime($eventDate) >= strtotime(date('Y-m-d'))) {
                $upcomingTickets[] = $combined;
            } else {
                $pastTickets[] = $combined;
            }
            }

            
        }
        return ['upcoming'=>$upcomingTickets,'past'=>$pastTickets];

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