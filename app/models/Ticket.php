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
        if ($data['ticket_type'] === 'paid' && (empty($data['price']) || !is_numeric($data['price']))) {
            $this->errors['price'] = "Price is required for paid tickets and must be a valid number.";
        }

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
}