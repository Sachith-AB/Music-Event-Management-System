<?php

class UpcomingEvents {

    use Controller;
    use Model;
    public function index() {

        $this->view('ticket/upcommingevent');
    }
}