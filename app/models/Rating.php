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
}