<?php

class Services {
    use Model;

    protected $table = 'services'; // Define the table name
    protected $allowedColumns = [
        'user_id',
        'service'
    ];
}