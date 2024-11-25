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
        'cover_images',
        'pricing',
        'type',
        'createdBy',
        'address'
    ];

    public function validEvent($data) {

        $this->errors = [];

        //flage mean errors include

        if (empty($data['event_name'])) {
            $this->errors['flag'] = true;
            $this->errors['error'] = "Event name is required";
            $this->errors['error_no'] = 1;
            return ;
        }

        if (empty($data['description'])) {
            $this->errors['flag'] = true;
            $this->errors['error'] = "Event description is required";
            $this->errors['error_no'] = 2;
            return ;
        }


        if (empty($data['audience'])) {
            $this->errors['flag'] = true;
            $this->errors['error'] = "Audience is required";
            $this->errors['error_no'] = 3;
        }


        // if (empty($data['city'])) {
        //     $this->errors['flag'] = true;
        //     $this->errors['error'] = "City is required";
        //     $this->errors['error_no'] = 4;
        // }

        // if (empty($data['province'])) {
        //     $this->errors['flag'] = true;
        //     $this->errors['error'] = "Province is required";
        //     $this->errors['error_no'] = 5;
        // }

        if (empty($data['eventDate'])) {
            $this->errors['flag'] = true;
            $this->errors['error'] = "Event date is required";
        } else {
            // Convert the event date to a timestamp
            $eventDate = DateTime::createFromFormat('Y-m-d', $data['eventDate']);
            $today = new DateTime('today'); // Today's date
        
            if (!$eventDate) {
                // Invalid date format
                $this->errors['error'] = "Invalid date format. Please use YYYY-MM-DD.";
            } elseif ($eventDate <= $today) {
                // Event date must be in the future
                $this->errors['flag'] = true;
			    $this->errors['error'] = "Event date must be in the future";
			    $this->errors['error_no'] = 6;
            }
        }
        
        if (empty($data['start_time'])) {
            $this->errors['flag'] = true;
            $this->errors['error'] = "Start time is required";
            $this->errors['error_no'] = 7;
        } elseif (empty($data['end_time'])) {
            $this->errors['flag'] = true;
            $this->errors['error'] = "End time is required";
            $this->errors['error_no'] = 8;
        } else {
            // Convert times to DateTime objects for comparison
            $startTime = $data['start_time'] ;//DateTime::createFromFormat('H:i', $data['start_time']);
            $endTime = $data['end_time']; //DateTime::createFromFormat('H:i', $data['end_time']);
        
            if (!$startTime || !$endTime) {
                $this->errors['flag'] = true;
                $this->errors['error'] = "Invalid time format. Use HH:MM.";
                $this->errors['error_no'] = 9;
            } elseif ($startTime >= $endTime) {
                $this->errors['flag'] = true;
                $this->errors['error'] = "Start time must be earlier than the end time";
                $this->errors['error_no'] = 10;
            }
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

    public function getRecentEvents($limit = 4) {
        // Directly inject the $limit value into the query
        $query = "SELECT * FROM events ORDER BY eventDate DESC LIMIT $limit";
    
        return $this->query($query);
    }
    

    public function searchEventByName($searchTerm){

        $searchName = $searchTerm['name'] ?? "";
        
        $query = "SELECT * FROM events WHERE event_name LIKE '%$searchName%'";
        $result = $this->query($query);
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
        $user = new User;
        
        $res['performers'] = [];
        $query_1 = "SELECT * FROM requests WHERE event_id = $id AND (role ='singer' OR role = 'band' OR role='announcer') AND Status = 'accepted' ";
        $result_1 = $this->query($query_1);

        if(!empty($result_1)){
            foreach($result_1 as $performer){
                $res['performers'][]=$user->firstById($performer->collaborator_id);
            }
        }
        


        $res['tickets'] = [];

        $query = "SELECT * FROM tickets WHERE event_id = '$id'";
        
        $result = $this->query($query);
        if(!empty($result)){
            $res['tickets']=$result;
        }
        show($res);
        return $res ? $res : [];
    }


    


}
