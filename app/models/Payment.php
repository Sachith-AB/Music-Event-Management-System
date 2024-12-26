<?php 

class Payment {
    use Model;

    protected $table = 'payments';
    protected $allowedColumns = ['id','user_id', 'event_id', 'payment'];

    
}    
