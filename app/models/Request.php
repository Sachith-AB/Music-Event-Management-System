<?php

class Request {
    use Model;

    protected $table = 'requests'; //database table name
    protected $allowedColumns = [
        'id','event_id','collaborator_id','Status','role',
    ];

    // public function getSingerDetails()
    // {
    //     $query = "SELECT u.id, u.name, u.pro_pic, p.userID, p.user_role
    //         FROM users u
    //         JOIN profile p ON u.id = p.userID
    //         WHERE p.user_role = 'singer'";



    public function getSingerRequests($user_id)
    {
        $event = new Event;        

        $query = "SELECT e.id AS event_id, e.event_name, e.eventDate, e.cover_images,e.address, r.id AS request_id
            FROM events e
            JOIN requests r ON r.event_id = e.id AND r.Status = 'pending' AND r.collaborator_id = $user_id";


        $result = $this->query($query);

        return $result;

        

    }

    public function getAcceptedRequests($user_id)
    {

        $query = "SELECT e.id AS event_id, e.event_name, e.eventDate, e.cover_images,e.address, r.id AS request_id
            FROM events e
            JOIN requests r ON r.event_id = e.id AND r.Status = 'accepted' AND r.collaborator_id = $user_id";

            
            $result = $this->query($query);

            return $result;
    }


    public function getUpcomingEvents($user_id, $limit = 3) 
{
    $query = "SELECT 
                e.id AS event_id, 
                e.event_name, 
                e.eventDate, 
                e.cover_images, 
                e.address, 
                r.id AS request_id
              FROM 
                events e
              JOIN 
                requests r 
                ON r.event_id = e.id 
                AND r.Status = 'accepted' 
                AND r.collaborator_id = $user_id
              WHERE 
                e.eventDate > CURDATE() -- Only upcoming events
              ORDER BY 
                e.eventDate ASC -- Sort by the closest upcoming event
              LIMIT $limit"; 

    $result = $this->query($query);

    return $result;
}

  public function getAcceptedEvents($id){

    $query = "SELECT events.* 
        FROM events 
        INNER JOIN requests 
        ON events.id = requests.event_id 
        WHERE requests.collaborator_id = $id 
        AND requests.status = 'accepted'";

    $result = $this->query($query);
    return $result;
  }

}



