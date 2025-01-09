<?php 

class EventPlanners {

    use Controller;
    use Model;

    public function index()
    {
        $deletedusers = new Deletedusers;
        $user = new User;
        $event = new Event;
        $data = [];
        $data = $this->DisplayEventPlanners($event);
        // show($data);
       

        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])){

            // show($_POST);
            $this->deleteUsers($user,$deletedusers);
        }

        $this->view('admin/eventplaners', $data);

    }

    public function DisplayEventPlanners($event)
    {
        $res = $event->getUsers();
        return $res;
    }

    public function deleteUsers($user,$deletedusers)
    {
        $data = $user->firstById($_POST['user_id']);
        $data = json_decode(json_encode($data),true);
        $data['user_id'] = $data['id'];
        // show($data);
        $deletedusers->insert($data);

        $user->delete($_POST['user_id']);



    }

   
}