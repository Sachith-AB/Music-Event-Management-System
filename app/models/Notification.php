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
    public function getNotifications($user_id) {
        // Directly inject the $limit value into the query
        $query = "SELECT * FROM notifications WHERE user_id = $user_id";
    
        return $this->query($query);
    }

    public function getNewnotifications($user_id) {
        // Directly inject the $limit value into the query
        $query = "SELECT * FROM notifications WHERE user_id = $user_id AND is_read = 0";
    
        return $this->query($query);
    }

    public function markasread($user_id) {
        $notification = new Notification;
        $query = "UPDATE notifications SET is_read = 1 WHERE user_id = ?";
        $notification->query($query, [$user_id]);
    }
}