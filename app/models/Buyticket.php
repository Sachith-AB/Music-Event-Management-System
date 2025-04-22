<?php

class Buyticket {
    use Model;
    protected $table = 'buyticket';  // Database table name
    protected $allowedColumns = [
        'id', 'user_id', 'ticket_id', 'buyer_Fname', 'buyer_Lname', 'buyer_phoneNo',
        'buyer_email', 'event_id', 'ticket_quantity', 'buy_time','payment_status'
    ];




    public function validePurchase($data){
        $this->errors = [];

        

        // Validate quantity
        if (empty($data['buyer_Fname'])) {
			$this->errors['flag'] = true;
			$this->errors['error'] = "Frist name is Required ";
			$this->errors['error_no'] = 1;
			return;
		}
        if (empty($data['buyer_Lname'])) {
			$this->errors['flag'] = true;
			$this->errors['error'] = "Last name is Required ";
			$this->errors['error_no'] = 1;
			return;
		}
        if (empty($data['buyer_phoneNo'])) {
			$this->errors['flag'] = true;
			$this->errors['error'] = "Phone number is Required ";
			$this->errors['error_no'] = 1;
			return;
		}elseif (!preg_match('/^\d{10}$/', $data['buyer_phoneNo'])) {
            $this->errors['flag'] = true;
            $this->errors['error'] = "Phone number must be exactly 10 digits";
            $this->errors['error_no'] = 1;
            return;
        }




        if (empty($data['buyer_email'])) {
			$this->errors['flag'] = true;
			$this->errors['error'] = "Email is Required";
			$this->errors['error_no'] = 1;
			return;
		}elseif (!filter_var($data['buyer_email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['flag'] = true;
            $this->errors['error'] = "Invalid email format";
            $this->errors['error_no'] = 1;
            return;
        }
    
        // if (empty($data['ticket_type'])) {
		// 	$this->errors['flag'] = true;
		// 	$this->errors['error'] = "Ticket Type is Required ";
		// 	$this->errors['error_no'] = 1;
		// 	return;
		// }
        if (empty($data['ticket_quantity'])) {
			$this->errors['flag'] = true;
			$this->errors['error'] = "Quantity is Required ";
			$this->errors['error_no'] = 1;
			return;
		}
        if ($data['ticket_quantity'] > $data['available_quantity']) {
			$this->errors['flag'] = true;
			$this->errors['error'] = "Available ticket quantity is not enough";
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

    public function getEventBuyers($userId) {
        // SQL query to retrieve ticket buyer details for events created by the logged-in user
        $query = "SELECT 
                events.id AS event_id,
                events.event_name,
                buyticket.buyer_Fname,
                buyticket.buyer_Lname,
                buyticket.buyer_phoneNo,
                buyticket.buyer_email,
                buyticket.ticket_quantity,
                buyticket.buy_time,
                tickets.ticket_type,
                tickets.price
            FROM events
            JOIN buyticket ON events.id = buyticket.event_id
            LEFT JOIN tickets ON buyticket.ticket_id = tickets.id
            WHERE events.createdBy = ?
        ";
    
        // Execute the query using the logged-in user ID
        $result =  $this->query($query, [$userId]);
        return $result ? $result : [];
    }

    public function getLatestInsertedId() {
        $query = "SELECT MAX(id) AS last_insert_id FROM buyticket";
        $result = $this->query($query); // Run the query, assuming query() is a method available in your model
        return $result[0]->last_insert_id;
    }

    public function getPurchaseDetails($purchase_id){
        $query = "SELECT * from buyticket WHERE id=?";
        return $this->query($query, [$purchase_id]);
    
    }

    public function getAllPurchasedEvents($userId){
        $query = "SELECT * from buyticket WHERE payment_status = 'complete' AND user_id=?";
        return $this->query($query, [$userId]);
    }

    public function changePaymentStatus($purchase_id){
        $query = "UPDATE buyticket SET payment_status = 'complete' WHERE id = ?";
        return $this->query($query, [$purchase_id]);
    }
    public function getticketbuyers($event_id){
        $query = "SELECT DISTINCT user_id FROM buyticket WHERE event_id = ?";
        $result = $this->query($query, [$event_id]);
        return $result;
    }
    public function getTicketAndPurchaseDetails($userId, $event_id){
        $query = "SELECT buyticket.*, tickets.ticket_type, tickets.price FROM buyticket 
                  JOIN tickets ON buyticket.ticket_id = tickets.id 
                  WHERE buyticket.payment_status = 'complete' AND buyticket.user_id = ? AND buyticket.event_id = ?";
        return $this->query($query, [$userId, $event_id]);
    }
}