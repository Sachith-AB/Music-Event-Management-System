<?php

class Event {
    use Model;

    protected $table = 'events'; // Define the table name
    protected $allowedColumns = [
        'event_name',
        'description',
        'audience',
        'city',
        'province',
        'eventDate',
        'start_time',
        'end_time'
    ];

    public function validEvent($data) {

        $this->errors = [];

        //flage mean errors include

        if (empty($data['event_name'])) {
            $this->errors['event_name'] = "Event name is required";
            return ;
        }

        if (empty($data['description'])) {
            $this->errors['description'] = "Event description is required";
            return ;
        }


        if (empty($data['audience'])) {
            $this->errors['audience'] = "Audience is required";
        }


        if (empty($data['city'])) {
           $this->errors['city'] = "City is required";
        }

        if (empty($data['province'])) {
            $this->errors['province'] = "Province is required";
        }

        if (empty($data['eventDate'])) {
            $this->errors['eventDate'] = "Event date is required";
        }

        if (empty($data['start_time'])) {
        $this->errors['start_time'] = "Start time is required";
        }


        if (empty($this->errors)) {
            return true;
        }

        return false;
    }

    public function searchEventByName($searchTerm){

        $searchName = $searchTerm['name'] ?? "";
       
        
        $id = $searchTerm['location']?? '';
        
        $query = "SELECT * FROM events WHERE event_name LIKE '%$searchName%' OR venueID = '$id'";
        $result = $this->query($query);
        // if($result){
        //     return $result;
        // }else{
        //     return [];
        // }
        //show($result);
        return $result ? $result : [];

    }

    public function filterEvents($searchTerm) {
        $searchType = $searchTerm['type'] ?? "";
        $searchPricing = $searchTerm['pricing'] ?? "";
    
        // Start building the query
        $query = "SELECT * FROM events WHERE 1=1";  // The 1=1 acts as a placeholder to make appending conditions easier
    
        // Add conditions only if they are not empty
        if (!empty($searchType)) {
            $query .= " AND type LIKE '%$searchType%'";
        }
        
        if (!empty($searchPricing)) {
            $query .= " AND pricing LIKE '%$searchPricing%'";
        }
    
        $result = $this->query($query);
        return $result ? $result : [];
    }

    public function getAllEventData($id) {
        $res['event']=[];
        $res['event'] = $this->firstById($id);
        $request = new Request;
        $user = new User;
        
        // // Step 1: Split the performers string into an array of IDs
        // $performerIds = explode(',', $res['event']->performers);
        
        // Step 2: Initialize an array to store performer data
        $res['performers'] = [];
        
    
        // Step 3: Loop through each ID and fetch data for each performer
        // foreach ($performerIds as $performerId) {
        //     $res['performers'][] = $user->firstById(trim($performerId));
        // }
        $query_1 = "SELECT * FROM requests WHERE event_id = $id AND (role ='singer' OR role = 'band' OR role='announcer') ";
        $result_1 = $this->query($query_1);
        //show($result_1);

        foreach($result_1 as $performer){
            $res['performers'][]=$user->firstById($performer->collaborator_id);
        }
        //show($res['performers']);


        $res['tickets'] = [];

        $query = "SELECT * FROM tickets WHERE event_id = '$id'";
        
        
        $result = $this->query($query);
        $res['tickets']=$result;

        $query_2 = "SELECT * FROM venues WHERE event_id = '$id'";
        $result_2 = $this->query($query_2);
        $res['venue'] = $result_2;
        

    show($res);
        return $res ? $res : [];
    }
    
    



}