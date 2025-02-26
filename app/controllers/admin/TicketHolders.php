<?php 

class TicketHolders {

    use Controller;
    use Model;

    public function index()
    {
        $user = new User;
        $event = new Event;
        $data = [];

        $data = $this->getHolderDetails($event);
        // show($data);

        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])){

            $this->deleteHolders($user);
        }

        $this->view('admin/ticketholders', $data);

    }

    public function getHolderDetails($event)
    {
        $res = $event->getUsers();
        return $res;
    }

    public function deleteHolders($user)
    {
        $id = $_POST['user_id'];
        
        $user->update($id, $_POST);

        // redirect('admin-ticketholders');

    }
   
}