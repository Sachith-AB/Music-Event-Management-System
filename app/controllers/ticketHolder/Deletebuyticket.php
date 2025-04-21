<?php
class Deletebuyticket{

    use Controller;
    use Model;

    public function index(){
        $buyticket = new BuyTicket;
        $ticket = new Ticket;

        $user_id = $_SESSION['USER']->id ?? null;
        // show($user_id);
        $event_id = htmlspecialchars($_GET['id'] ?? null);
        $data = $this->getPurchaseDetails($buyticket, $user_id, $event_id);
        // show($data);
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_purchase'])) {
            // Get the purchase ID from POST data
            $purchase_id = htmlspecialchars($_POST['purchase_id'] ?? null);
            // Delete the purchase record
            $buyticket->delete($purchase_id);
            // Redirect to the same page to refresh the data
            redirect("delete-buyticket?id=" . $event_id);
        }



        $this->view('ticketHolder/delete-buyticket',$data);

    }
    public function getPurchaseDetails($buyticket, $user_id, $event_id){
        // Fetch purchase details for the logged-in user and event ID
        $purchaseDetails = $buyticket->getTicketAndPurchaseDetails($user_id, $event_id);
        return $purchaseDetails;
    }

    public function deleteTicket()
    {
        $ticket = new Ticket;

        // Get the ticket ID from POST data
        $ticket_id = htmlspecialchars($_GET['ticket_id']?? null);

        $data = $ticket->getTicketAndEventDetails($ticket_id);
        // show($data);
        // Fetch the event ID associated with this ticket
        $event_id = $ticket->getEventIdByTicketId($ticket_id);

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])) {
            // Delete the ticket
            $ticket->delete($ticket_id);

            // Use a redirect function to navigate to the view-tickets page with the event_id
            redirect("view-tickets?event_id=" . $event_id);
        }
        $this->view('ticket/deleteticket', $data);
    }
}