<?php 

class User {
    use Model;

    protected $table = 'users';
    protected $allowedColumns = [
        'name',
        'email',
        'password',
        'username',
        'pro_pic'
    ];
}