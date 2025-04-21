<?php

class Calender {
    use Controller;

    public function index(){
        $request = new Request;
        $calendar = new Calendar;
        $id = $_SESSION['USER']->id;
        $data = [];

        // Get accepted events
        $data = $this->getAcceptedEvent($id, $request);
        
        // Get user's calendar entries for unavailable dates
        $unavailableDates = $calendar->getUserCalendar($id);
        if(!empty($unavailableDates)) {
            foreach($unavailableDates as $date) {
                if($date->is_available == 0) {
                    $data[] = [
                        'eventDate' => $date->date,
                        'event_name' => 'Unavailable',
                        'description' => 'You are not available on this date',
                        'cover_images' => '',
                        'status' => 'process',
                        'start_time' => ''
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
}