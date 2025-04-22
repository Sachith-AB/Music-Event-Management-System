<?php 

class SingerPastEvents {

    use Controller;
    use Model;

    public function index()
    {
        $event = new Event;
        $data = [];

        $data = $this->getPastCollaboratorEvents($event);
        // show($data);

        $this->view('eventCollaborator/singerPastevents',$data);

    }

    public function getPastCollaboratorEvents($event)
    {
        $user_id = $_SESSION['USER']->id;

        $result = $event->getPastEventsInfoForCollaborators($user_id);

        return $result;
    }

   
}