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

   
}