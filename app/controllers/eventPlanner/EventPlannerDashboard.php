<?php

class EventPlannerDashboard {
    use Controller;

    public function index() {
        // Ensure the user is logged in and get their ID
        if (!$this->isLoggedIn()) {
            redirect('signin');
            exit();
        }

        // Assuming $_SESSION['USER'] holds the logged-in user's details, including ID
        $userId = $_SESSION['USER']->id;

        $buyTicketModel = new Buyticket();
        $eventBuyers = $buyTicketModel->getEventBuyers($userId);

        // Fetch events created by this user
        $eventModel = new Event(); // Assuming Event model exists
        $userEvents = $eventModel->getEventsByUserId($userId);
        
        // usort($userEvents, function($a, $b) {
        //     return strtotime($b->createdAt) - strtotime($a->createdAt);
        // });

        $totalRevenue = 0;
        $totalTicketsSold = 0;
        $totalTicket=0;
        $totalEvents = count($userEvents) ?? 0; // Number of events
        $totalEventBuyers = count($eventBuyers) ?? 0;

        // Calculate total revenue and total tickets sold
        foreach ($userEvents as $event) {
            $totalRevenue += $event->total_revenue;
            $totalTicketsSold += $event->sold_quantity;
            $totalTicket += $event->total_quantity;
        }
        

        // Pass the events data to the view
        $this->view('eventPlanner/dashboard', ['events' => $userEvents,'eventBuyers' => $eventBuyers,'totalRevenue' => $totalRevenue,
            'totalTicketsSold' => $totalTicketsSold,'totalEvents' => $totalEvents,'totalEventBuyers' => $totalEventBuyers, 'totalTicket'=> $totalTicket]);
    }


    

}

