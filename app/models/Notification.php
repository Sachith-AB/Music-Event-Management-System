<?php 

class Notification {
    use Model;

    protected $table = 'notifications';
    protected $allowedColumns = [
        
        'user_id',
        'title',
        'message',
        'is_read',
        'created_at'
		
    ];

    public function getNotifications($event_id) {
        // Directly inject the $limit value into the query
        $query = "SELECT * FROM notifications WHERE event_id = $event_id";
    
        return $this->query($query);
    }
}