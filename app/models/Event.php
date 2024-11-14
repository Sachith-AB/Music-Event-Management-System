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
        'end_time',
        'pricing',
        'type'
    ];

    public function validEvent($data) {
        $this->errors = [];


        //Event name validation
        if (empty($data['event_name'])) {
            $this->errors['event_name'] = "Event name is required";
            return ;
        }

        //Description validation
        if (empty($data['description'])) {
            $this->errors['description'] = "Event description is required";
            return ;
        }

        //Audience validation 
        if (empty($data['audience'])) {
            $this->errors['audience'] = "Audience is required";
        }
            elseif (!is_numeric($data['audience']) || $data['audience'] <= 0) {
                $this->errors['audience'] = "Audience must be a positive number.";
            }

        //City validation
        if (empty($data['city'])) {
           $this->errors['city'] = "City is required";
        }

        //Province validation
        if (empty($data['province'])) {
            $this->errors['province'] = "Province is required";
        }

        //Event date validation
        if (empty($data['eventDate'])) {
            $this->errors['eventDate'] = "Event date is required";
        } elseif (!$this->isValidDate($data['eventDate'])){
            $this->errors['eventDate'] = "Event date is not in the correct format(Y-m-d)";
        } elseif (strtotime($data['eventDate']) < strtotime(date('Y-m-d'))) {
            $this->errors['eventDate'] = "Event date must be after today.";
        }

        //Start time validation
        if (empty($data['start_time'])) {
        $this->errors['start_time'] = "Start time is required";
        } elseif (!$this->isValidTime($data['start_time'])){
            $this->errors['start_time'] = "Start time is not in the correct format(H:i)";
        }

        //End time validation
        if (empty($data['end_time'])){
            $this->error['end_time'] = "End time is required";
        } elseif (!$this->isValidTime($data['end_time'])){
            $this->errors['end_time'] = "End time is not in the correct format(H:i)";
        } elseif (strtotime($data['end_time']) <= strtotime($data['start_time'])){
            $this->errors['end_time'] = "End time must be after start time";
        }

        // Pricing validation
        if (empty($data['pricing'])) {
            $this->errors['pricing'] = "Pricing is required";
        } 

        // Type validation
        if (empty($data['type'])) {
            $this->errors['type'] = "Event type is required";
        }
        
        if (empty($this->errors)) {
            return true;
        }


        return false;
    }


        //Helper function to validate date format
        private function isValidDate($date) {
            $d = DateTime::createFromFormat('Y-m-d', $date);
            return $d && $d->format('Y-m-d') === $date;
        }
        

        //Helper function to validate time format
        private function isValidTime($time){
            $t = DateTime::createFromFormat('H:i', $time);
            return $t && $t->format('H:i') === $time;
        }


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

    public function getRecentEvents($limit = 4) {
        // Directly inject the $limit value into the query
        $query = "SELECT * FROM events ORDER BY eventDate DESC LIMIT $limit";
    
        return $this->query($query);
    }
    

    public function searchEventByName($searchTerm){

        $searchName = $searchTerm['name'] ?? "";
       
        
        $id = $searchTerm['location']?? '';
        
        $query = "SELECT * FROM events WHERE event_name LIKE '%$searchName%' OR venueID = '$id'";
        $result = $this->query($query);
        // if($result){
        //     return $result;
        // }else{
        //     return [];
        // }
        //show($result);
        return $result ? $result : [];

    }

    public function filterEvents($searchTerm) {
        $searchType = $searchTerm['type'] ?? "";
        $searchPricing = $searchTerm['pricing'] ?? "";
    
        // Start building the query
        $query = "SELECT * FROM events WHERE 1=1";  // The 1=1 acts as a placeholder to make appending conditions easier
    
        // Add conditions only if they are not empty
        if (!empty($searchType)) {
            $query .= " AND type LIKE '%$searchType%'";
        }
        
        if (!empty($searchPricing)) {
            $query .= " AND pricing LIKE '%$searchPricing%'";
        }
    
        $result = $this->query($query);
        return $result ? $result : [];
    }

    public function getAllEventData($id) {
        $res['event']=[];
        $res['event'] = $this->firstById($id);
        $request = new Request;
        $user = new User;
        
        // // Step 1: Split the performers string into an array of IDs
        // $performerIds = explode(',', $res['event']->performers);
        
        // Step 2: Initialize an array to store performer data
        $res['performers'] = [];
        
    
        // Step 3: Loop through each ID and fetch data for each performer
        // foreach ($performerIds as $performerId) {
        //     $res['performers'][] = $user->firstById(trim($performerId));
        // }
        $query_1 = "SELECT * FROM requests WHERE event_id = $id AND (role ='singer' OR role = 'band' OR role='announcer') ";
        $result_1 = $this->query($query_1);
        //show($result_1);

        foreach($result_1 as $performer){
            $res['performers'][]=$user->firstById($performer->collaborator_id);
        }
        //show($res['performers']);


        $res['tickets'] = [];

        $query = "SELECT * FROM tickets WHERE event_id = '$id'";
        
        
        $result = $this->query($query);
        $res['tickets']=$result;

        $query_2 = "SELECT * FROM venues WHERE event_id = '$id'";
        $result_2 = $this->query($query_2);
        $res['venue'] = $result_2;
        

    show($res);
        return $res ? $res : [];
    }


    


}


    
    
    






