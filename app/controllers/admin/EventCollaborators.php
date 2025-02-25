<?php 

class EventCollaborators {

    use Controller;
    use Model;

    public function index()
    {
        $user = new User;
        $event = new Event;
        $data = [];

        $data = $this->DisplayCollaborators($event);
        // show($data);

        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])){

            $this->DeleteCollaborators($user);

        }
        
        $this->view('admin/collaborators', $data);

    }

    public function DisplayCollaborators($event)
    {
        $res = $event->getAllCollaborators();
        return $res;
    }

    public function DeleteCollaborators($user)
    {
        $id = $_POST['user_id'];
        $user->update($id, $_POST);
        // redirect('admin-eventCollaborators');
    }

   
}