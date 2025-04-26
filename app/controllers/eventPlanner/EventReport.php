<?php

class EventReport {

    use Controller;

    public function index () {
        $id=$_SESSION["USER"]->id;
        //show($id);
        $data['pastEvent']= $this->getEventPlannerPastEventInfoWithTickets($id);
        //show($data['pastEvent']);
        $this->view('eventPlanner/eventReport', ['data' => $data]);
    }

    public function getEventPlannerPastEventInfoWithTickets($id) {
        $event = new Event;
        $data = $event->EventPlannerPastEventInfoWithTickets($id);  
        //show($data);
        return $data;
    }
}
