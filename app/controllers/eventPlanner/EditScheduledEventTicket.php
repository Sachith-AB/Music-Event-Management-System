<?php

class EditScheduledEventTicket {

    use Controller;
    use Model;

    public function index() {
        $ticket = new Ticket;
        $data = [];
        

        $ticket_id = $_GET['ticket_id'] ?? null;
        $data = $ticket->getTicketDetails($ticket_id);
        // show($data);


        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
            $data['errors'] = $this->updateTicket($ticket, $_POST);
        }

        $this->view('ticket/editscheduledeventticket',['data'=>$data, 'errors'=>$data['errors']??null]);

    }
    public function updateTicket($ticket,$POST){
        $event = new Event;
        $ticket_id = $_GET['ticket_id'] ?? null;
        $data['ticket'] = $ticket->getTicketDetails($ticket_id);
        $ticket_details = $data['ticket'][0];
        $event_id = $ticket_details->event_id; // Get the event ID from the ticket details
        $event_details =$event->firstById($event_id);


        if (isset($POST['restrictions']) && is_array($POST['restrictions'])) {
            $POST['restrictions'] = json_encode($POST['restrictions']);
            //show($_POST);
        }

        if ($ticket->validTicket($_POST)) {

            if($POST['sale_strt_date'] > $POST['sale_end_date']) {
                $data['errors'] = ['error' => "Sale start date cannot be later than sale end date"];
            }
            elseif($event_details->eventDate < $POST['sale_strt_date']) {
                $data['errors'] = ['error' => "Sale start date cannot be later than event date"];
            }
            elseif($event_details->eventDate < $POST['sale_end_date']) {
                $data['errors'] = ['error' => "Sale end date cannot be later than event date"];
            }
            elseif($POST['discount']<0 || $POST['discount'] > $ticket_details->price) {
                $data['errors'] = ['error' => "Discount amount cannot be less than 0 or greater than ticket price"];
            }
            else{

                unset($POST['update']); // Remove the submit key
                //show($_POST);
                // Update the ticket
                $ticket->update($ticket_id, $POST);
                redirect("event-planner-scheduledEvent?id=".$POST['event_id']);
            }
        } else {
            $data['errors'] = $ticket->errors;
        }
        return $data['errors'];
    } 
}