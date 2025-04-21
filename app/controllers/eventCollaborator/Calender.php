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
      
       // show($events);
        
        // Get unavailable dates
        $unavailableDates = $calendar->getUserCalendar($id);
       // show("Unavailable dates:");
       // show($unavailableDates);
        
        // Combine events and unavailable dates
        $data = $events;
        
        if(!empty($unavailableDates)) {
            foreach($unavailableDates as $date) {
                if($date->is_available == 0) {
                    $data[] = (object)[
                        'eventDate' => $date->date,
                        'event_name' => 'Unavailable',
                        'description' => 'You are not available on this date',
                        'status' => 'unavailable'
                    ];
                }
            }
        }
        
       // show("Final data for view:");
       // show($data);
        
        $this->view('eventCollaborator/calender', $data);
    }

    private function getAcceptedEvent($id, $request){
        $res = $request->getAcceptedEvents($id);
        return $res ?: [];
    }
}