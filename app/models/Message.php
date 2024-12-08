<?php 

class Message {
    use Model;

    protected $table = 'messages';
    protected $allowedColumns = [
        
        'event_id',
        'event_planner',
        'sender',
        'message',
		
    ];

}