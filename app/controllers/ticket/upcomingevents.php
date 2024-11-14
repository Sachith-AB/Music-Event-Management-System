<?php

class UpcomingEvents {

    use Controller;
    use Model;
    public function index() {

        if (!$this->isLoggedIn()) {
            redirect('signin');
            exit();
        }

        // Assuming $_SESSION['USER'] holds the logged-in user's details, including ID
        $userId = $_SESSION['USER']->id;
        $username = $_SESSION['USER']->name;
        $email = $_SESSION['USER']->email;
        $pro_pic = $_SESSION['USER']->pro_pic;

        $buyticket = new Buyticket();
        $mytickets = $buyticket->getAllPurchasedEvents($userId);
        // show($mytickets);

        $ticket = new Ticket();

        $ticket = new Ticket();

        // Create a combined array of ticket and event details
        $combinedTickets = [];
        foreach ($mytickets as $myticket) {
            $ticket_id = $myticket->ticket_id; // Extract ticket_id from each element
            $eventDetail = $ticket->getTicketAndEventDetails($ticket_id); // Call the function for each ticket_id

            // Merge ticket and event details into a single array for each ticket
            $combinedTickets[] = array_merge((array)$myticket, (array)$eventDetail);
        }
        // show($combinedTickets); // Debug output for the combined array
        // show($pro_pic); // Debug output for profile picture

        $event = new Event();
        $recevtevents = $event->getRecentEvents(4);

        $this->view('ticket/upcommingevent', ['pro_pic'=>$pro_pic,'username'=>$username, 'email'=> $email,'recentevents' => $recevtevents,'combinedTickets'=>$combinedTickets]);
    }
    
}