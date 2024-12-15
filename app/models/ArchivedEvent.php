<?php

class ArchivedEvent {
    use Model;

    protected $table = 'archived_event'; // Table name
    protected $allowedColumns = [
        'id',
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
        'archived_at',
        'event_id'
    ];

    
}
