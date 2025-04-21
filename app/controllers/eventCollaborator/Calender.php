<?php

class Calender {
    use Controller;

    public function index(){
        $request = new Request;
        $calendar = new Calendar;
        $id = $_SESSION['USER']->id;
        $data = [];

        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addUnavailableDate'])){
            $this->addUnavailableDate($id, $_POST);
        }

        // Get user's calendar entries
        $data['calendar'] = $calendar->getUserCalendar($id);
        // Get accepted events
        $data['events'] = $this->getAcceptedEvent($id, $request);
        
        // Add unavailable dates to events
        if(!empty($data['calendar'])) {
            foreach($data['calendar'] as $entry) {
                if($entry->is_available == 0) {
                    $data['events'][] = [
                        'eventDate' => $entry->date,
                        'event_name' => 'Unavailable',
                        'description' => 'I am not available on this date',
                        'cover_images' => null,
                        'status' => 'process',
                        'start_time' => '',
                        'is_unavailable' => true
                    ];
                }
            }
        }

        $this->view('eventCollaborator/calender', $data);
    }

    private function getAcceptedEvent($id, $request){
        $res = $request->getAcceptedEvents($id);
        return $res;
    }

    private function addUnavailableDate($id, $post){
        $calendar = new Calendar;
        $date = $post['unavailableDate'];
        
        // Check if entry exists
        $existing = $calendar->getUserCalendar($id);
        $exists = false;
        
        foreach($existing as $entry) {
            if($entry->date == $date) {
                $exists = true;
                break;
            }
        }
        
        if($exists) {
            $calendar->updateAvailability($id, $date, 0);
        } else {
            $calendar->setAvailability($id, $date, 0);
        }
    }
}