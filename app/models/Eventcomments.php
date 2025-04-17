<?php

class Eventcomments {
    use Model;

    protected $table = 'eventcomments'; // Define the table name
    protected $allowedColumns = [
        'id',
        'event_id',
        'user_id',
        'comment',
        'num_likes',
        'created_at',
        'updated_at',
        
    ];



    public function getCommnet($eventId) {
        $query = "SELECT 
            eventcomments.*, 
            users.name AS sender_name, 
            users.pro_pic AS sender_pro_pic
        FROM 
            eventcomments
        JOIN 
            users 
        ON 
            eventcomments.user_id = users.id
        WHERE 
            eventcomments.event_id = ?";
        $result = $this->query($query, [$eventId]);
        
        // Return the result array, or an empty array if no results are found
        return $result ?: [];
    }

}