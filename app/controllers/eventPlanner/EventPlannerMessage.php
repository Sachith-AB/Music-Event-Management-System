<?php

class EventPlannerMessage {

    use Controller;

    public function index() {
        $messageModel = new Message;
    
        // Fetch messages for the logged-in planner
        $eventplannerid = $_SESSION['USER']->id;
        $eventMessages = $messageModel->getEventMessages($eventplannerid);
    
        // Pass data to the view
        $this->view('eventPlanner/message', ['eventMessages' => $eventMessages]);
    }
    
}