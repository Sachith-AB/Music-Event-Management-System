<?php 

class EventCollaborators {

    use Controller;
    use Model;

    public function index()
    {
        $this->view('admin/collaborators');

    }

   
}