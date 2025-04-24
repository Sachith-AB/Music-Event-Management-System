<?php

class Calender {
    use Controller;

    public function index(){
        $request = new Request;
        $calendar = new Calendar;
        $id = $_SESSION['USER']->id;
        
        // Handle form submission for unavailable dates
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
            
            //show($_POST);
            
            $date = $_POST['date'];
            $is_available = 0; 
            
            // Save to calendar table
           
            $result = $calendar->setAvailability($id, $date, $is_available);
            
            //show($result);
            
            
        }

        // Get accepted events
        $events = $this->getAcceptedEvent($id, $request);
        
        // Format event times for regular events
        if(!empty($events)) {
            foreach($events as &$event) {
                // Format times to 12-hour format
                if(isset($event->start_time)) {
                    $time = strtotime($event->start_time);
                    $event->start_time = date('h:i A', $time);
                }
                if(isset($event->end_time)) {
                    $time = strtotime($event->end_time);
                    $event->end_time = date('h:i A', $time);
                }
            }
            unset($event); // Break the reference
        }
        
        // Get unavailable dates
        $unavailableDates = $calendar->getUserCalendar($id);
       // show("Unavailable dates:");
       // show($unavailableDates);
        
        // Combine events and unavailable dates
        $data = $events ?: [];
        
        if(!empty($unavailableDates)) {
            foreach($unavailableDates as $date) {
                if($date->is_available == 0) {
                    $data[] = (object)[
                        'eventDate' => $date->date,
                        'event_name' => 'Unavailable',
                        'description' => 'I am not available on this date',
                        'status' => 'unavailable',
                        'start_time' => 'All Day',
                        'end_time' => 'All Day'
                    ];
                }
            }
        }
        
        $this->view('eventCollaborator/calender', $data);
    }

    private function getAcceptedEvent($id, $request){
        $res = $request->getAcceptedEvents($id);
        if($res) {
            foreach($res as &$event) {
                // Format times to 12-hour format
                if(isset($event->start_time)) {
                    $time = strtotime($event->start_time);
                    $event->start_time = date('h:i A', $time);
                }
                if(isset($event->end_time)) {
                    $time = strtotime($event->end_time);
                    $event->end_time = date('h:i A', $time);
                }
            }
            unset($event); // Break the reference
        }
        return $res ?: [];
    }
}