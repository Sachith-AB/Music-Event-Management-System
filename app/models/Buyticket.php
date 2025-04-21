<?php

class Buyticket {
    use Model;
    protected $table = 'buyticket';  // Database table name
    protected $allowedColumns = [
        'id', 'user_id', 'ticket_id', 'buyer_Fname', 'buyer_Lname', 'buyer_phoneNo',
        'buyer_email', 'event_id', 'ticket_quantity', 'buy_time','payment_status'
    ];


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
    
}