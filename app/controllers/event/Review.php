<?php

class Review {
    use Controller;

    public function index() {
        $this->view('event/eventReview', ['event' => []]);
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