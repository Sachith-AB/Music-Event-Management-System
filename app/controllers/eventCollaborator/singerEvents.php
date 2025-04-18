<?php 

class SingerEvents {

    use Controller;
    use Model;

    public function index()
    {
        $event = new Event;
        $data = [];

        $data = $this->getFutureCollaboratorEvents($event);
        // show($data);

        $this->view('eventCollaborator/singerFutureevents',$data);

    }

    public function getFutureCollaboratorEvents($event)
    {
        $user_id = $_SESSION['USER']->id;

        $result = $event->getFutureEventsInfoForCollaborators($user_id);

        return $result;
    }

   
}