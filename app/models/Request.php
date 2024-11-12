<?php

class Request {
    use Model;

   

    protected $table = 'requests'; //database table name
    protected $allowedColumns = [
        'id','event_id','collaborator_id','Status','role',
    ];

    // public function getSingerDetails()
    // {
    //     $query = "SELECT u.id, u.name, u.pro_pic, p.userID, p.user_role
    //         FROM users u
    //         JOIN profile p ON u.id = p.userID
    //         WHERE p.user_role = 'singer'";



    public function getSingerRequests($user_id)
    {
        $query =   "SELECT e.id AS event_id, e.event_name, e.eventDate, e.venueID, v.id AS venue_id, v.name AS venue_name, v.location
                    FROM events e
                    JOIN requests r ON r.event_id = e.id AND r.role = 'Singer' AND r.collaborator_id = $user_id  
                    JOIN venues v ON e.venueID = v.id";

        return ($result = $this->query($query));
    }

   

    //     $result = $this->query($query);
    //     return $result;
    // }

    // public function searchSingers($searchTerm) {

    //     $searchTerm = $searchTerm['searchTerm'];
    //     //Query for search
    //     $query = "SELECT u.id, u.name, u.pro_pic, p.userID, p.user_role
    //                 FROM users u
    //                 JOIN profile p ON u.id = p.userID
    //                 WHERE p.user_role = 'singer'
    //                 AND (
    //                         u.name LIKE '%$searchTerm%' OR
    //                         p.biography LIKE '%$searchTerm%' OR
    //                         p.music_genres LIKE '%$searchTerm'OR
    //                         p.past_works LIKE '%$searchTerm%' OR
    //                         p.services LIKE '%$searchTerm%' OR
    //                         p.specializations LIKE '%$searchTerm%' OR
    //                         p.equipment LIKE '%$searchTerm%'
    //                 )";

    //     // Execute the query and return results
    //     $result = $this->query($query);

    //     // Assuming you have a database connection and an execution method here
    //     return $result;
    // }
    

        
        
        
}



