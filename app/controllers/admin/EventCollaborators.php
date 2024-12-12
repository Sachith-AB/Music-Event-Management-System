<?php 

class EventCollaborators {

    use Controller;
    use Model;

    public function index()
    {
        $event = new Event;
        $data = [];

        $data = $this->DisplayCollaborators($event);
        show($data);
        
        $this->view('admin/collaborators', $data);

    }

    public function DisplayCollaborators($event)
    {
        $res = $event->getAllCollaborators();
        return $res;
    }

   
}