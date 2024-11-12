<?php

class EventPlannerMyEvents {

    use Controller;
    public function index() {
        // Ensure the user is logged in and get their ID
        if (!$this->isLoggedIn()) {
            redirect('signin');
            exit();
        }

        // Assuming $_SESSION['USER'] holds the logged-in user's details, including ID
        $userId = $_SESSION['USER']->id;

        $eventModel = new Event(); // Assuming Event model exists
        $userEvents = $eventModel->getEventsByUserId($userId);
        // show($userEvents);

        $this->view('eventPlanner/myevents',['events' => $userEvents]);
    }
}