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

    private function createTicket($ticket, $POST) {
        // Validate event/ticket data
        if ($ticket->validTicket($_POST)) {  // Use the validTicket method from the model
            unset($POST['submit']);  // Remove the submit key

            // Insert data into the tickets table
            if ($ticket->insert($_POST)) {
                // Redirect on successful insert
                // redirect('signin');
                echo("create ticket correctly");
            } else {
                // Handle insertion error
                $error = "Failed to create ticket. Please try again.";
                redirect("ticket/createticket?error=" . urlencode($error));
            }
        } else {
            // If validation fails, return errors
            return $ticket->errors;
        }
    }
}
