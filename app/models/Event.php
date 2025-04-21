<?php

use LDAP\Result;

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
        'address',
        'status',
        'is_delete'
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

        if (empty($data['eventEndDate'])) {
            $this->errors['flag'] = true;
            $this->errors['error'] = "Event date is required";
        } else {
            // Convert the event date to a timestamp
            $eventEndDate = DateTime::createFromFormat('Y-m-d', $data['eventEndDate']);
            $today = new DateTime('today'); // Today's date
        
            if (!$eventEndDate) {
                // Invalid date format
                $this->errors['error'] = "Invalid date format. Please use YYYY-MM-DD.";
            } elseif ($eventEndDate <= $today) {
                // Event date must be in the future
                $this->errors['flag'] = true;
                $this->errors['error'] = "Event date must be in the future";
                $this->errors['error_no'] = 6;
            }
        }

        if (!empty($data['eventDate']) && !empty($data['eventEndDate']) && isset($eventDate, $eventEndDate)) {
            if ($eventDate > $eventEndDate) {
                $this->errors['flag'] = true;
                $this->errors['error'] = "Event date must be before or equal to the event end date.";
                $this->errors['error_no'] = 7;
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
                $this->errors['error_no'] = 9;}
            // } elseif ($startTime<= $endTime) {
            //     $this->errors['flag'] = true;
            //     $this->errors['error'] = "Start time must be earlier than the end time";
            //     $this->errors['error_no'] = 10;
            // }      
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
            WHERE events.createdBy = ? AND events.is_delete = '0'
        ";
        $result = $this->query($query, [$userId]);
    
        // Return the result array, or an empty array if no results are found
        return $result ?: [];
    }

    public function getCompletedEvents($userId) {
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
    AND events.is_delete = '0'
    AND events.status = 'completed'";

        return $this->query($query, [$userId]);
    }

    public function getEventPlannerPayments($userId) {
        $query = "SELECT 
            e.id as event_id,
            e.event_name,
            e.eventDate,
            e.status,
            e.createdBy,
            p.user_id,
            p.payment_timestamp,
            u.name as user_name,

            SUM(p.payment) as total_payment
        FROM payments p
        JOIN events e ON p.event_id = e.id
        JOIN users u ON p.user_id = u.id
        WHERE e.createdBy = ? 
        AND e.is_delete = '0'
        GROUP BY e.id, p.user_id
        ORDER BY e.eventDate DESC, total_payment DESC";

        return $this->query($query, [$userId]);
    }

    public function getRecentEvents($limit = 4) {
        // Directly inject the $limit value into the query
        $query = "SELECT * FROM events WHERE status='scheduled'AND is_delete = '0' ORDER BY eventDate DESC LIMIT $limit";
    
        return $this->query($query);
    }
    

    public function searchEventByName($searchTerm){

        $searchName = $searchTerm['name'] ?? "";
        
        $query = "SELECT * FROM events WHERE is_delete = '0' AND event_name LIKE '%$searchName%'";
        $result = $this->query($query);
        return $result ? $result : [];

    }

    public function filterEvents($searchTerm) {
        $searchType = $searchTerm['type'] ?? "";
        $searchPricing = $searchTerm['pricing'] ?? "";
    
        // Start building the query
        $query = "SELECT * FROM events WHERE is_delete = '0' AND 1=1";  // The 1=1 acts as a placeholder to make appending conditions easier
    
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
        $profile = new Profile;
        
        $res['performers'] = [];
        $query_1 = "SELECT * FROM requests WHERE event_id = $id AND (role ='singer' OR role = 'band' OR role='announcer') AND Status = 'accepted' ";
        $result_1 = $this->query($query_1);

        if(!empty($result_1)){
            foreach($result_1 as $performer){
                $res['performers'][]=array_merge(
                    (array)$user->firstById($performer->collaborator_id),
                    (array)$profile->getProfileInfoByUserId($performer->collaborator_id)
                );
            }
        }

        


        $res['tickets'] = [];

        $query = "SELECT * FROM tickets WHERE event_id = '$id'";
        
        $result = $this->query($query);
        if(!empty($result)){
            $res['tickets']=$result;
        }
        return $res ? $res : [];
    }
    

    public function getProcessingEvents()
    {
       

        $query = "SELECT e.id AS event_id,e.event_name,e.eventDate,e.start_time,e.address,e.createdBy,e.cover_images,u.id AS user_id,u.name AS user_name from events e
                  JOIN users u on e.createdBy = u.id
                  WHERE e.is_delete = '0' AND e.status = 'processing'
                  ";

        $result = $this->query($query);
        return $result;
    }

    public function getAlreadyHeldEvents()
    {
        $query = "SELECT e.id AS event_id, 
                        e.event_name, 
                        e.eventDate, 
                        e.start_time, 
                        e.address, 
                        e.createdBy, 
                        e.cover_images, 
                        u.id AS user_id, 
                        u.name AS user_name,
                        ROUND(AVG(r.rating), 1) AS average_rating,
                        COUNT(r.id) AS total_ratings
                 FROM events e
                 JOIN users u ON e.createdBy = u.id
                 LEFT JOIN rating r ON e.id = r.event_id
                 WHERE e.is_delete = '0' 
                 AND e.eventDate < CURRENT_DATE
                 GROUP BY e.id, e.event_name, e.eventDate, e.start_time, e.address, e.createdBy, e.cover_images, u.id, u.name";

        $result = $this->query($query);
        return $result;
    }

    public function getScheduledEvents()
    {
        $query = "SELECT e.id AS event_id, 
                        e.event_name, 
                        e.eventDate, 
                        e.start_time, 
                        e.address, 
                        e.createdBy, 
                        e.cover_images, 
                        e.status,
                        u.id AS user_id, 
                        u.name AS user_name,
                        ROUND(AVG(r.rating), 1) AS average_rating,
                        COUNT(r.id) AS total_ratings
                 FROM events e
                 JOIN users u ON e.createdBy = u.id
                 LEFT JOIN rating r ON e.id = r.event_id
                 WHERE e.is_delete = '0' 
                 AND e.status = 'scheduled'
                 GROUP BY e.id, e.event_name, e.eventDate, e.start_time, e.address, e.createdBy, e.cover_images, e.status, u.id, u.name
                 ORDER BY e.eventDate ASC, e.start_time ASC";

        $result = $this->query($query);
        return $result;
    }

    public function getUsers()
    {
        $query = "SELECT id,name,email,contact,role from users WHERE is_delete = '0'";

        $result = $this->query($query);
        return $result;
    }

    public function getAllCollaborators()
    {
        $query = "SELECT u.id as user_id,u.name as user_name,u.email,u.contact,u.role,p.userID,p.user_role 
                  from users u 
                  join profile p on u.id = p.userID
                  WHERE u.is_delete = '0' AND u.role = 'collaborator'";

        $result = $this->query($query);
        return $result;
    }

    public function getPastEvents()
    {
        $query = "SELECT e.id AS event_id,e.event_name AS user_id,u.name AS user_name from events e
                  JOIN users u on e.createdBy = u.id
                  WHERE e.is_delete = '0' AND e.eventDate < CURRENT_DATE
                  ";

        $result = $this->query($query);
        return $result;
    }
    

    public function getFutureEvents()
    {
        $query = "SELECT e.id AS event_id,e.event_name AS user_id,u.name AS user_name from events e
        JOIN users u on e.createdBy = u.id
        WHERE e.is_delete = '0' AND e.eventDate > CURRENT_DATE
        ";

    $result = $this->query($query);
    return $result;
    }


     
     
     public function getfullFutureEventInfo()
     {
        $query = "SELECT e.id AS event_id, e.event_name, e.eventDate, planner.id AS event_planner_id, planner.name AS event_planner_name,
                    GROUP_CONCAT(u.name SEPARATOR ', ') AS collaborators
                    FROM events e
                    JOIN users planner ON e.createdBy = planner.id  -- Get event planner details
                    LEFT JOIN requests r ON e.id = r.event_id AND r.status = 'accepted'  -- Get accepted collaborator requests
                    LEFT JOIN users u ON r.collaborator_id = u.id  -- Get collaborator details
                    WHERE e.is_delete = '0' 
                    AND e.eventDate > CURRENT_DATE  -- Only fetch upcoming events
                    GROUP BY e.id, e.event_name, e.eventDate, planner.id, planner.name;";

        $result = $this->query($query);
        return $result;
     }
     public function geteventplannerinfo($event_id){
        $query = "SELECT * FROM users JOIN events ON events.createdBy = users.id WHERE events.id = $event_id";
    
        return $this->query($query);
     }

     public function getFullPastEventInfoWithTickets()
     {
         $query = "SELECT e.id AS event_id, e.event_name, e.eventDate, planner.id AS event_planner_id, planner.name AS event_planner_name,
                    GROUP_CONCAT(DISTINCT u.name SEPARATOR ', ') AS collaborators,
                    IFNULL(SUM(t.price * b.ticket_quantity), 0) AS total_income,
                    IFNULL(SUM(b.ticket_quantity), 0) AS total_sold_tickets,
                    IFNULL(SUM(p.payment), 0) AS total_payments
                    FROM events e
                    JOIN users planner ON e.createdBy = planner.id
                    LEFT JOIN requests r ON e.id = r.event_id AND r.status = 'accepted'
                    LEFT JOIN users u ON r.collaborator_id = u.id
                    LEFT JOIN buyticket b ON e.id = b.event_id
                    LEFT JOIN tickets t ON b.ticket_id = t.id
                    LEFT JOIN payments p ON e.id = p.event_id
                    WHERE e.is_delete = '0' 
                    AND e.eventDate < CURRENT_DATE
                    GROUP BY e.id, e.event_name, e.eventDate, planner.id, planner.name
                    ORDER BY total_income DESC, total_sold_tickets DESC";
     
        $result = $this->query($query);
         return $result ? $result : [];
     }

    public function getEventRatings($eventId)
    {
        $query = "SELECT r.*, 
                        u.name AS user_name,
                        u.profile_image
                 FROM rating r
                 JOIN users u ON r.user_id = u.id
                 WHERE r.event_id = ?
                 ORDER BY r.created_at DESC";

        return $this->query($query, [$eventId]);
    }

    public function getEventAverageRating($eventId)
    {
        $query = "SELECT 
                        ROUND(AVG(rating), 1) AS average_rating,
                        COUNT(*) AS total_ratings
                 FROM rating 
                 WHERE event_id = ?";

        return $this->query($query, [$eventId])[0] ?? null;
    }

    public function getStarRating($rating) {
        $fullStars = floor($rating);
        $halfStar = ($rating - $fullStars) >= 0.5;
        $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);
        
        $stars = '';
        
        // Add full stars
        for ($i = 0; $i < $fullStars; $i++) {
            $stars .= '<i class="fas fa-star" style="color: #00BDD6FF;"></i>';
        }
        
        // Add half star if needed
        if ($halfStar) {
            $stars .= '<i class="fas fa-star-half-alt" style="color: #00BDD6FF;"></i>';
        }
        
        // Add empty stars
        for ($i = 0; $i < $emptyStars; $i++) {
            $stars .= '<i class="far fa-star" style="color: #666;"></i>';
        }
        
        return $stars;
    }
    public function getFutureEventsInfoForCollaborators($user_id)
      {
         $query = "SELECT e.id, e.event_name, e.eventDate, e.cover_images, e.address FROM events e 
                     JOIN requests r ON
                     e.id = r.event_id 
                     WHERE r.Status = 'accepted' AND e.eventDate > CURRENT_DATE AND r.collaborator_id = $user_id";
 
         $result = $this->query($query);
         return $result ? $result : [];
 
      }
}
