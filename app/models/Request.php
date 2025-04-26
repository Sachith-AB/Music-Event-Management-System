<?php

class Request {
    use Model;

    protected $table = 'requests'; //database table name
    protected $allowedColumns = [
        'id','event_id','collaborator_id','Status','role'];

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

    public function getCollaboratorRequests($eventId)
    {
        $query = "SELECT u.id, u.pro_pic, u.name, r.Status 
                  FROM requests r
                  JOIN users u ON r.collaborator_id = u.id
                  WHERE r.event_id = $eventId";

        $result = $this->query($query);

        return $result;

    }

    public function getAcceptedEvents($id)
    {
        $query = "SELECT events.* 
              FROM events 
              INNER JOIN requests 
              ON events.id = requests.event_id 
              WHERE requests.collaborator_id = $id 
              AND requests.status = 'accepted'";

          $result = $this->query($query);
          return $result;
    }

    public function getRequestsForCollaborators( $start_date, $end_date )
    {

        $query = "SELECT 
                      r.collaborator_id, 
                      r.role, 
                      u.name,
                      COUNT(r.id) AS request_count,
                      SUM(CASE WHEN r.status = 'accepted' THEN 1 ELSE 0 END) AS accepted_count,
                      SUM(CASE WHEN r.status = 'rejected' THEN 1 ELSE 0 END) AS rejected_count,
                      SUM(CASE WHEN r.status = 'pending' THEN 1 ELSE 0 END) AS pending_count
                  FROM 
                      requests r
                  JOIN 
                      users u ON r.collaborator_id = u.id
                  WHERE 
                      r.request_datetime BETWEEN '$start_date' AND '$end_date' 
                  GROUP BY 
                      r.collaborator_id
                  ORDER BY 
                      request_count DESC
                  ";

          $result = $this->query($query);
          return $result;

    }

}



