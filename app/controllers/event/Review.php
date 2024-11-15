<?php

class Review {
    use Controller;

    public function index() {
        $event = new Event;
        $data = [];
        $data = $this -> fetchEventDetails($event);
        $this->view('event/eventReview' , $data);
    }

    public function fetchEventDetails($event){
        $array['event_name'] = htmlspecialchars($_GET['event_name']);
        $row = $event->first($array);
        //show ($row);
        $data = json_decode(json_encode($row),true);
        return $data;
    }
    public function review() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $eventDetails = $_POST;

            $this->view('event/eventReview', ['event' => $eventDetails]);
        } else {
            $this->view('event/eventReview', ['event' => []]);
        }
    }
}