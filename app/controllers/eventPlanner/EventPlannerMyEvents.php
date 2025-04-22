<?php

class EventPlannerMyEvents {

    use Controller;
    public function index() {
        // Ensure the user is logged in and get their ID
        if (!$this->isLoggedIn()) {
            redirect('signin');
            exit();
        }

        // Get showMore values from POST request for each section
        $showMoreProcessing = false;
        $showMoreScheduled = false;
        $showMoreCompleted = false;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['showMoreProcessing'])) {
                $showMoreProcessing = $_POST['showMoreProcessing'] === 'true';
            }
            if (isset($_POST['showMoreScheduled'])) {
                $showMoreScheduled = $_POST['showMoreScheduled'] === 'true';
            }
            if (isset($_POST['showMoreCompleted'])) {
                $showMoreCompleted = $_POST['showMoreCompleted'] === 'true';
            }
        }

        // Assuming $_SESSION['USER'] holds the logged-in user's details, including ID
        $userId = $_SESSION['USER']->id;

        $eventModel = new Event(); // Assuming Event model exists
        $userEvents = $eventModel->getEventsByUserId($userId);
        // show($userEvents);

        // Pass data to the view
        $data = [
            'events' => $userEvents,
            'showMoreProcessing' => $showMoreProcessing,
            'showMoreScheduled' => $showMoreScheduled,
            'showMoreCompleted' => $showMoreCompleted
        ];

        $this->view('eventPlanner/myevents', $data);
    }
}