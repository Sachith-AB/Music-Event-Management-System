<?php

class EventPlannerPayment {

    use Controller;
    public function index() {
        // Ensure the user is logged in and get their ID
        if (!$this->isLoggedIn()) {
            redirect('signin');
            exit();
        }

        $userId = $_SESSION['USER']->id;
        $this->getEventPlannerPayments($userId);
        $data = $this->getEventPlannerPayments($userId);
       // show($data);
        $this->view('eventPlanner/payment', $data);
    }

    public function getEventPlannerPayments($userId) {
        $eventModel = new Event();
        $eventPlannerPayments = $eventModel->getEventPlannerPayments($userId);
        return $eventPlannerPayments;
    }
}