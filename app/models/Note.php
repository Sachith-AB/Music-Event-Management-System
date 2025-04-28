<?php 

class Note {
    use Model;

    protected $table = 'event_notes';
    protected $allowedColumns = [
        'event_id',
        'user_id',
        'note',
        'created_at',
        'updated_at'
		
    ];

}