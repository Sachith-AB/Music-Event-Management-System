<?php


class TicketController {

    use Controller;

    public function index() {
        $ticket = new Ticket;  // Ticket model instance
        $data = [];

        // Handle form submission
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
            $data = $this->createTicket($ticket, $_POST);  // Pass form data to the createTicket method
        }

        $this->view('ticket/createticket', $data);  // Render view with any data (including errors)
    }

    public function viewTickets() {
        $ticket = new Ticket; // Ticket model instance
    
        // Get event_id from the query parameters
        $event_id = $_GET['event_id'] ?? null;
    
        if ($event_id) {
            // Get tickets for the specified event
            $data = $ticket->getTicketsByEventId($event_id);
        } else {
            // Fallback: get all tickets if no event_id is passed
            $data = $ticket->getAllTickets();
        }
    
        // Render the view with tickets data
        $this->view('ticket/viewtickets', ['tickets' => $data]);
    }
    

    private function createTicket($ticket, $POST) {
        // First, get the event_id for the given event name
        $eventName = $POST['event_name'];  // Ensure you have an input named 'event_name' in your form
        $event_id = $ticket->getEventIdByName($eventName);

        if (!$event_id) {
            // Handle the error if no event is found
            return ['error' => "No event found with the name $eventName"];
        }

        // Include event_id in the POST data
        $POST['event_id'] = $event_id;
        
        // Validate event/ticket data
        if ($ticket->validTicket($POST)) {
            unset($POST['submit']);  // Remove the submit key
            $ticket->insert($POST); // Insert data into the tickets table
            redirect("view-tickets?event_id=" . $event_id);
        } else {
            // If validation fails, return errors
            return $ticket->errors;
        }
    }
}