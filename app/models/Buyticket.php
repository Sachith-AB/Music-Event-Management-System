<?php

class Buyticket {
    use Model;


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
        return $this->query($query, [$userId]);
    }
    

}