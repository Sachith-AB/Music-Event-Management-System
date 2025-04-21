<?php 

class AdminDashboard {

    use Controller;
    use Model;

    public function index()
    {
        $event = new Event;
        $data = [];

        $data['upcoming'] = $this->displayUpcomingEvents($event);
        // show($data['upcoming']);

        $data['held'] = $this->displayAlreadyHeldEvents($event);
        // show($data['held']);

        // echo json_encode($data['upcoming']);

        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])){

            
            $this->deleteEvent($event);
        }


        $this->view('admin/admindashboard',$data);

    }



    public function displayUpcomingEvents($event)
    {
    //    $offset = isset($_GET['offset']) ? intval($_GET['offset']) : 0;
    //    $limit = 6;
    
        $res = $event->getUpcomingEvents();
        return $res;

    }

    public function displayAlreadyHeldEvents($event)
    {

        $res = $event->getAlreadyHeldEvents();
        return $res;
    }


    private function deleteEvent($event) {

        $id = $_POST['event_id'];
       
        $event->update($id, $_POST);

        // $data = $event->firstById($_POST['event_id']);
        // $data = json_decode(json_encode($data),true);
        // $data['event_id'] = $data['id'];
        // // show($data);

        // $deletedEvent->insert($data);
        // $event->delete($_POST['event_id']);

        // redirect('admin-dashboard');
    }
}