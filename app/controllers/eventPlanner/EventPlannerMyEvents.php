<?php

class EventPlannerMyEvents {

    use Controller;

    public function index () {
        $this->view('eventPlanner/myevents');
    }
}