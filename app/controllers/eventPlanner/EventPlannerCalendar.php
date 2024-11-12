<?php

class EventPlannerCalendar {

    use Controller;

    public function index () {
        $this->view('eventPlanner/calendar');
    }
}