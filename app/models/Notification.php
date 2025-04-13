<?php 

class Notification {
    use Model;

    protected $table = 'notifications';
    protected $allowedColumns = [
        
        'event_id',
        'title',
        'message',
        'is_read',
        'created_at'
		
    ];
}