<?php

class Comment {
    use Model;

    protected $table = 'comments'; // Define the table name
    protected $allowedColumns = [
        'id',
        'sender_id',
        'receiver_id',
        'content',
        'num_likes',
        'created_at',
        'updated_at',
        
    ];



    public function getCommnet($receiverId) {
        $query = "SELECT 
            comments.*, 
            users.name AS sender_name, 
            users.pro_pic AS sender_pro_pic
        FROM 
            comments
        JOIN 
            users 
        ON 
            comments.sender_id = users.id
        WHERE 
            comments.receiver_id = ?";
        $result = $this->query($query, [$receiverId]);

        // Return the result array, or an empty array if no results are found
        return $result ?: [];
    }

}