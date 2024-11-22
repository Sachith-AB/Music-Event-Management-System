<?php

class Successfullypaid {

    use Controller;
    use Model;
    public function index() {

        $buyticket = new Buyticket();

        $purchase_id = isset($_GET['purchase_id']) ? $_GET['purchase_id'] : null;
        $purchaseDetails = $buyticket->getPurchaseDetails($purchase_id);

        $ticket = new Ticket();
        $eventAndTicketDetails = $ticket->getTicketAndEventDetails($purchaseDetails[0]->ticket_id);

        $event = new Event();
        $recevtevents = $event->getRecentEvents(4);


        $this->view('ticket/successfullypaid', ['purchaseDetails' => $purchaseDetails, 'eventAndTicketDetails'=> $eventAndTicketDetails,'recentevents' => $recevtevents]);
    }
}