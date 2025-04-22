<?php 

class Ticket {
    use Model;

    protected $table = 'tickets';  // Database table name
    protected $allowedColumns = [
        'id', 'event_id', 'ticket_type', 'price', 'quantity', 'sold_quantity',
        'sale_strt_date', 'sale_strt_time', 'sale_end_date', 'sale_end_time','restrictions','discount'
    ];

    public function validTicket($data) {
        $this->errors = [];

        

        // Validate quantity
        if (empty($data['sale_strt_date'])) {
			$this->errors['flag'] = true;
			$this->errors['error'] = "Sale Start Date is Required ";
			$this->errors['error_no'] = 1;
			return;
		}
        if (empty($data['sale_strt_time'])) {
			$this->errors['flag'] = true;
			$this->errors['error'] = "Sale Start Time is Required ";
			$this->errors['error_no'] = 1;
			return;
		}
        if (empty($data['sale_end_date'])) {
			$this->errors['flag'] = true;
			$this->errors['error'] = "Sale End Date is Required ";
			$this->errors['error_no'] = 1;
			return;
		}
        if (empty($data['sale_end_time'])) {
			$this->errors['flag'] = true;
			$this->errors['error'] = "Sale End Time is Required ";
			$this->errors['error_no'] = 1;
			return;
		}
        // if (empty($data['ticket_type'])) {
		// 	$this->errors['flag'] = true;
		// 	$this->errors['error'] = "Ticket Type is Required ";
		// 	$this->errors['error_no'] = 1;
		// 	return;
		// }
        if (empty($data['quantity'])) {
			$this->errors['flag'] = true;
			$this->errors['error'] = "Quantity is Required ";
			$this->errors['error_no'] = 1;
			return;
		}
        if (empty($data['price'])) {
			$this->errors['flag'] = true;
			$this->errors['error'] = "Price is Required ";
			$this->errors['error_no'] = 1;
			return;
		}
        
        

        // Validate price if the ticket is paid
        // if ($data['ticket_type'] === 'paid' && (empty($data['price']) || !is_numeric($data['price']))) {
        //     $this->errors['price'] = "Price is required for paid tickets and must be a valid number.";
        // }

        // Validate sale dates and times
        // if (empty($data['sale_strt_date']) || empty($data['sale_end_date'])) {
        //     $this->errors['sale_dates'] = "Both start and end sale dates are required.";
        // }

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

    public function getTicketAndEventDetails($ticket_id) {
        $query = "SELECT 
                    tickets.id AS ticket_id, 
                    tickets.ticket_type AS ticket_type, 
                    tickets.price AS ticket_price, 
                    tickets.quantity AS ticket_quantity,
                    tickets.discount AS discount,
                    events.id AS event_id, 
                    events.event_name AS event_name, 
                    events.description AS event_description,
                    events.cover_images AS event_images,
                    events.start_time AS event_date, 
                    events.end_time AS event_endtime,
                    events.address AS address
                    FROM 
                        tickets 
                    JOIN 
                        events ON tickets.event_id = events.id
                    WHERE 
                        tickets.id = :ticket_id";
        $params = ['ticket_id' => $ticket_id];
        return $this->query($query, $params);
    }


    public function decreaseQuantity($ticket_id, $ticket_quantity) {
        $query = "UPDATE tickets 
                    SET sold_quantity = sold_quantity + :ticket_quantity, 
                        quantity = quantity - :ticket_quantity 
                    WHERE id = :ticket_id AND quantity >= :ticket_quantity";
        
        $params = [
            'ticket_quantity' => $ticket_quantity,
            'ticket_id' => $ticket_id
        ];
    
        return $this->query($query, $params);
    }


    public function getTicketIncomeOverTime($event_id) {
        $query = "SELECT 
                      DATE(buy_time) AS purchase_date, 
                      SUM(t.price * b.ticket_quantity) AS total_income 
                  FROM buyticket b
                  JOIN tickets t ON b.ticket_id = t.id
                  WHERE b.event_id = :event_id
                  GROUP BY DATE(buy_time)
                  ORDER BY purchase_date";
    
        $params = ['event_id' => $event_id]; // Bind event ID
        $result = $this->query($query, $params);
        return $result ? $result : [];
    }
    public function getPurchasedTicketCounts($event_id) {
        $query = "SELECT ticket_type, price, quantity, sold_quantity 
                  FROM tickets 
                  WHERE event_id = :event_id";
    
        $params = ['event_id' => $event_id];
        return $this->query($query, $params);
    }
    
    
    public function getEventTicketDetails() {
        $query = "SELECT 
                    e.event_name,
                    t.ticket_type,
                    SUM(t.quantity + t.sold_quantity) AS total_tickets_made,
                    t.quantity AS available_quantity,
                    t.sold_quantity AS sold_tickets,
                    t.price AS ticket_price
                  FROM 
                    events e
                  JOIN 
                    tickets t ON e.id = t.event_id
                  GROUP BY 
                    e.event_name, t.ticket_type, t.quantity, t.sold_quantity, t.price
                  ORDER BY 
                    e.event_name, t.ticket_type";
    
        $result = $this->query($query);
        return $result ? $result : [];
    }
    


    

}
