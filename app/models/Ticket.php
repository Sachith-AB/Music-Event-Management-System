<?php 

class Ticket {
    use Model;

    protected $table = 'tickets';  // Database table name
    protected $allowedColumns = [
        'id', 'event_id', 'ticket_type', 'price', 'quantity', 'sold_quantity',
        'sale_strt_date', 'sale_strt_time', 'sale_end_date', 'sale_end_time',
    ];

    public function validTicket($data) {
        $this->errors = [];

        

        // Validate quantity
        if (empty($data['quantity'])) {
            $this->errors['quantity'] = "Quantity is required.";
        } elseif (!is_numeric($data['quantity']) || $data['quantity'] <= 0) {
            $this->errors['quantity'] = "Quantity must be a positive number.";
        }

        // Validate price if the ticket is paid
        // if ($data['ticket_type'] === 'paid' && (empty($data['price']) || !is_numeric($data['price']))) {
        //     $this->errors['price'] = "Price is required for paid tickets and must be a valid number.";
        // }

        // Validate sale dates and times
        if (empty($data['sale_strt_date']) || empty($data['sale_end_date'])) {
            $this->errors['sale_dates'] = "Both start and end sale dates are required.";
        }

        // Return true if no errors, otherwise return false and keep the errors
        if (empty($this->errors)) {
            return true;  // Validation successful
        }

        return false;  // Validation failed
    }

    public function getEventIdByName($event_name) {
        $query = "SELECT id FROM events WHERE event_name = ?";
        $result = $this->query($query, [$event_name]);
        return $result ? $result[0]->id : null; // Access the first object's id property if result is not false
    }

    // Method to get tickets by event ID
    public function getTicketsByEventId($event_id) {
        $query = "SELECT * FROM tickets WHERE event_id = ?";
        return $this->query($query, [$event_id]);
    }
    
    
    //get all rows of the ticket table
    function getAllTickets(){
        $query = "SELECT ticket_type, price, quantity FROM tickets";
        
        return $this->query($query);
    }

    //get ticket details
    public function getTicketDetails($ticket_id) {
        $query = "SELECT * FROM tickets WHERE id = ?";
        return $this->query($query, [$ticket_id]);
    }

    public function delete($ticket_id){
    // Sanitize ticket_id to prevent SQL injection (if not using prepared statements)
    $ticket_id = intval($ticket_id); // Converts the ticket_id to an integer

    // Directly include ticket_id in the query (note: this approach assumes that ticket_id is sanitized)
    $query = "DELETE FROM tickets WHERE id = $ticket_id";
    return $this->query($query);
    }

    public function getEventIdByTicketId($ticket_id){
        $query = "SELECT event_id FROM tickets WHERE id = ?";
    $result = $this->query($query, [$ticket_id]);

    // Check if the result is not empty and return the `event_id` value directly
    return $result ? $result[0]->event_id : null;
        
    }


}
