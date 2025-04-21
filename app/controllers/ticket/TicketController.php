<?php


class TicketController {

    use Controller;

    public function index() {
        $ticket = new Ticket;  // Ticket model instance
        $event = new Event; // Event model instance
        $data = [];

        

        $event_id = $_GET['event_id'] ?? null;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            
            if (isset($_POST['add_another'])) {
                $data=$this->createTicket($ticket,$event, $_POST);  
                redirect("create-ticket?event_id=" . $event_id);  
            } elseif (isset($_POST['submit'])) {
                
                $data = $this->createTicket($ticket,$event, $_POST); 
                
            }
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
    

    private function createTicket($ticket,$event, $POST) {
        
        $event_id = htmlspecialchars($_GET['event_id']);
        $event_details =$event->firstById($event_id);
        

        if (!$event_id) {
            // Handle the error if no event is found
            return ['error' => "No event found with the$event_id"];
        }

        $POST['event_id'] = $event_id;

        if (isset($POST['restrictions']) && is_array($POST['restrictions'])) {
            $POST['restrictions'] = json_encode($POST['restrictions']);
        }
        
        
        if ($ticket->validTicket($POST)) {

            if($POST['sale_strt_date'] > $POST['sale_end_date']) {
                return ['error' => "Sale start date cannot be later than sale end date"];
            }
            elseif($event_details->eventDate < $POST['sale_strt_date']) {
                return ['error' => "Sale start date cannot be later than event date"];
            }
            elseif($event_details->eventDate < $POST['sale_end_date']) {
                return ['error' => "Sale end date cannot be later than event date"];
            }
            else{
            unset($POST['submit']);  
            unset($POST['add_another']);
            $ticket->insert($POST); 
            
            redirect('view-tickets?event_id='.$event_id);
            }
            
        } else {
            
            return $ticket->errors;
        }
    }

    public function updateTicket() {
        $ticket = new Ticket;
        $event = new Event; // Event model instance
        $ticket_id = $_GET['ticket_id'] ?? null;
        $data = [];
        $data['ticket'] = $ticket->getTicketDetails($ticket_id);
        $ticket_details = $data['ticket'][0];
        $event_id = $ticket_details->event_id; // Get the event ID from the ticket details
        $event_details =$event->firstById($event_id);
    
        if ($ticket_id) {
            // Load the current ticket data to display in the form
            $data['ticket'] = $ticket->getTicketDetails($ticket_id);
            // show($data['ticket'][0]);
    
            if (!empty($data['ticket']) && is_array($data['ticket'])) {
                $ticket_details = $data['ticket'][0]; // Assuming ticket details are stored in the first element
                
                // show($ticket_details->restrictions);  // To debug and see ticket data
                
                // Check if 'restrictions' are set in the ticket data and decode it if it exists
                if (isset($ticket_details->restrictions)) {
                    // Decode the JSON restrictions into a PHP array
                    $data['restrictions'] = json_decode($ticket_details->restrictions, true);
                } else {
                    // If no restrictions, set an empty array
                    $data['restrictions'] = [];
                }
            } else {
                // If no ticket data is returned
                $data['ticket'] = null;
                $data['restrictions'] = [];
            }
        
        }
    
        // Handle form submission for ticket update
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
            
            if (isset($_POST['restrictions']) && is_array($_POST['restrictions'])) {
                $_POST['restrictions'] = json_encode($_POST['restrictions']);
                //show($_POST);
            }
    
            if ($ticket->validTicket($_POST)) {

                if($_POST['sale_strt_date'] > $_POST['sale_end_date']) {
                    $data['errors'] = ['error' => "Sale start date cannot be later than sale end date"];
                }
                elseif($event_details->eventDate < $_POST['sale_strt_date']) {
                    $data['errors'] = ['error' => "Sale start date cannot be later than event date"];
                }
                elseif($event_details->eventDate < $_POST['sale_end_date']) {
                    $data['errors'] = ['error' => "Sale end date cannot be later than event date"];
                }
                else{

                    unset($_POST['update']); // Remove the submit key
                    //show($_POST);
                    // Update the ticket
                    $ticket->update($ticket_id, $_POST);
                    redirect("view-tickets?event_id=".$_POST['event_id']);
                }
            } else {
                $data['errors'] = $ticket->errors;
            }
        }
    
        // Render the update form with the ticket data
        $this->view('ticket/update-ticket', ['ticket' => $data, 'restrictions' => $data['restrictions'], 'errors' => $data['errors'] ?? null]);
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
