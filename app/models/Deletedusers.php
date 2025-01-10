<?php

class Deletedusers {

    use Model;

    protected $table = 'deletedusers';

    protected $allowedColumns = [

        'user_id',
        'name',
        'email',
        'password',
        'contact',
        'pro_pic',
        'role'
    ];
}