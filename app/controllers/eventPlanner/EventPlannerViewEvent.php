<?php 

class EventPlannerViewEvent {

    use Controller;
    use Model;

    public function index()
    {
        $this->view('eventPlanner/eventView');

    }

   
}