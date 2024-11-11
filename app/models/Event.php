<?php

class Event {
    use Model;

    protected $table = 'events'; // Define the table name
    protected $allowedColumns = [
        'event_name',
        'description',
        'audience',
        'city',
        'province',
        'eventDate',
        'start_time',
        'end_time'
    ];

    public function validEvent($data) {

        $this->errors = [];

        //flage mean errors include

        if (empty($data['event_name'])) {
            $this->errors['event_name'] = "Event name is required";
            return ;
        }

        if (empty($data['description'])) {
            $this->errors['description'] = "Event description is required";
            return ;
        }


        if (empty($data['audience'])) {
            $this->errors['audience'] = "Audience is required";
        }


        if (empty($data['city'])) {
           $this->errors['city'] = "City is required";
        }

        if (empty($data['province'])) {
            $this->errors['province'] = "Province is required";
        }

        if (empty($data['eventDate'])) {
            $this->errors['eventDate'] = "Event date is required";
        }

        if (empty($data['start_time'])) {
        $this->errors['start_time'] = "Start time is required";
        }


        if (empty($this->errors)) {
            return true;
        }

        return false;
    }

    //get events details for eventplanner dashboard which are created by him
    public function getEventsByUserId($userId) {
        $query = "SELECT 
                events.*,
                IFNULL(ticket_totals.total_quantity, 0) AS total_quantity,
                IFNULL(sold_data.sold_quantity, 0) AS sold_quantity,
                IFNULL(sold_data.total_revenue, 0) AS total_revenue
            FROM events
            LEFT JOIN (
                -- Subquery to get total quantity for each event
                SELECT tickets.event_id, SUM(tickets.quantity) AS total_quantity
                FROM tickets
                GROUP BY tickets.event_id
            ) AS ticket_totals ON events.id = ticket_totals.event_id
            LEFT JOIN (
                -- Subquery to get sold quantity and total revenue for each event
                SELECT tickets.event_id, SUM(buyticket.ticket_quantity) AS sold_quantity, SUM(tickets.price * buyticket.ticket_quantity) AS total_revenue
                FROM buyticket
                JOIN tickets ON buyticket.ticket_id = tickets.id
                GROUP BY tickets.event_id
            ) AS sold_data ON events.id = sold_data.event_id
            WHERE events.createdBy = ?
        ";
        $result = $this->query($query, [$userId]);

        // Return the result array, or an empty array if no results are found
        return $result ?: [];
    }


    


}

