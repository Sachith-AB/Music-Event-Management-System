<?php 

class EventPlanners {

    use Controller;
    use Model;

    public function index()
    {
        $event = new Event;
        $data = [];
        $data = $this->DisplayEventPlanners($event);
        // show($data);
        $this->view('admin/eventplaners', $data);

    }

    public function DisplayEventPlanners($event)
    {
        $res = $event->getUsers();
        return $res;
    }

   
}