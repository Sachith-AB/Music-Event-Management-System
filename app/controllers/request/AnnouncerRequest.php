<?php

class AnnouncerRequest {

    use Controller;
    
    public function index(){

        $request = new Request;
        $event = new Event;
        $notication = new Notification;

        $data = [];

        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['request'])) {

            $this->createRequest($request);
            $this->createNotification($event,$notication,$_POST);
        }
        
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['deleteRequest'])){

            $this->deleteRequest($request);
        }

        if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['searchAnnouncers'])){
            
            
            $data['users'] = $this->searchUsers($request);
            // show($data);
            // show($_POST);
        }else{
            $data['users'] = $this->getUsers($request);
        }

        $data['requests'] = $this->getExistingRequest($request);

        $this->view('request/announcerRequest',$data);
    }

    public function getUsers($request)
    {
        $data = $request->getUsersByRole('announcer','profile');
        return $data;

    }

    public function createRequest($request)
    {

    $res =  $request->insert($_POST);
    unset($_POST);
    //return $res;

    }

    public function searchUsers($request){
        
        $res = $request->searchByTerm($_POST , 'announcer' , 'profile');
        // show($res);
        unset($_POST['searchTerm']);
        unset($_POST['search']);
        return $res;
    }   

    public function getExistingRequest($request)
    {
        $id = htmlspecialchars($_GET['id']);

        //echo($id);

        $result = $request->getExistingRequests($id,'announcer');

        //show($result);

        //echo($id);

        //$result = $request->getExistingRequests($id);

       // show($result);


        return $result;

    }


    public function deleteRequest($request){

        $request->delete($_POST['req_id']);
        unset($_POST);
    }

    public function createNotification($event,$notification,$post){
        $eventDetails = $event->firstById($post['event_id']);
        $changes[] = "Event name: '{$eventDetails->event_name}' Event Date: '{$eventDetails->eventDate}'";
        $link = "colloborator-request";
        $notifymsg = [
            'user_id' => $post['collaborator_id'],
            'title' => "Recieved a request",
            'message' => json_encode($changes),
            'is_read' => 0,
            'link' => $link,
        ];
        $notification->insert($notifymsg);
    }


}