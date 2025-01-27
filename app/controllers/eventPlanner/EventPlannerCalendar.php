<?php

class EventPlannerCalendar {

    use Controller;

    public function index () {
        $event = new Event;
        $data= [];
        $id=$_SESSION["USER"]->id;
        
        $data = $this->getCreatedEvent($id,$event);
        $this->view('eventPlanner/calendar',$data);
    }

    private function getCreatedEvent($id,$event){
        $res = $event->getEventsByUserId($id);
        return $res;
    }
}