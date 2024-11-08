<?php

class Request {
    use Model;

    protected $table = 'requests'; //database table name
    protected $allowedColumns = [
        'id','event_id','collaborator_id','Status','role',
    ];
   
    public function getSingerDetails()
    {
        $query = "SELECT u.id, u.name, u.pro_pic, p.userID, p.user_role
                  FROM users u
                  JOIN profile p ON u.id = p.userID
                  WHERE p.user_role = 'singer'";

        return ($result = $this->query($query));
    }

   
        
        
        
    }



