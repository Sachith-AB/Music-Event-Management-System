<?php

class ProcessingEventDelete {
    use Controller;

    public function index() {

        $event = new Event;
        $archivedEvent = new ArchivedEvent();
        $data = $this->fetchEventDetails($event);
        $event_id = htmlspecialchars($_GET['event_id']);
        

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])) {
            $this->deleteEvent($event,$event_id, $archivedEvent);
        }
        $this->view('event/processingEventDelete', $data);


    }

    public function fetchEventDetails($event) {
        $array['id'] = htmlspecialchars($_GET['event_id']); 
        $row = $event->first($array);

        if (!$row) {
            // Handle invalid event ID
            die("Event not found.");
        }

        return json_decode(json_encode($row), true);
    }

    public function deleteEvent($event,$event_id, $archivedEvent) {
        // Validate event ID
        //if (!isset($_POST['event_id'])) {
           // die("Invalid event ID.");
        //}
        $row = $event->first(['id' => $event_id]);
        
        if ($row) {
            $data = json_decode(json_encode($row), true);
            $data['event_id'] = $event_id;
            unset($data['id']);

            // Insert the event into the archived table
            $archivedEvent->insert($data);
        } 

        // Move the event to the archive table
        //$this->archiveEvent($event, $archivedEvent, $_POST['id']);

        // Delete the event
        $event->delete($event_id,);

        // Redirect to the create-event page
        redirect("event-planner-dashboard");
    }

    private function archiveEvent($event, $archivedEvent, $event_id) {
        // Fetch the event details
        
    }
}
