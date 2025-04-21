<?php

class Rating {
    use Model;

    protected $table = 'rating';

    protected $allowedColumns = [
        'user_id',
        'event_id',
        'comment',
        'rating',
    ];

    public function getRatingFromEventId($event_id) {
        $query = "SELECT * FROM $this->table WHERE event_id = $event_id";
        $res = $this->query($query);
        
        return $res;
    }
    
}