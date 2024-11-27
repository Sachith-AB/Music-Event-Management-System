<?php

class Pastworks {
    use Model;

    protected $table = 'pastworks'; // Define the table name
    protected $allowedColumns = [
        'user_id',
        'past_work'
    ];
}