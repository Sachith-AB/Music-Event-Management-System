<?php

class ProcessingEventDelete {
    use Controller;

    public function index() {
        $event = new Event;
        $data = [];
        $data = $this -> fetchEventDetails($event);
        $this->view('event/processingEventDelete' , $data);

        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])){
            
            $this->deleteEvent($event);
        }
    }

    public function fetchEventDetails($event){
        $array['event_id'] = htmlspecialchars($_GET['event_id']);
        $row = $event->first($array);
        show ($row);
        $data = json_decode(json_encode($row),true);
        return $data;
    }

    public function deleteEvent($event) {
        // Validate event ID
        if (!isset($_POST['event_id']) || empty($_POST['event_id'])) {
            return;
        }
    
        // Delete the event
        $event->delete($_POST['event_id']);
    
        // Redirect to the create-event page
        //redirect("create-event");
    }
    
    
}