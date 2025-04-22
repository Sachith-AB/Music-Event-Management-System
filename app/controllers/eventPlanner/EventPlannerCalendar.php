<?php

class EventPlannerCalendar {

    use Controller;

    public function index () {
        $event = new Event;
        $data= [];
        $id=$_SESSION["USER"]->id;
        
        $events = $this->getCreatedEvent($id,$event);
        
        // Format events data for calendar
        $formattedEvents = [];
        foreach ($events as $event) {
            // Format times to 12-hour format
            $start_time = isset($event->start_time) ? date('h:i A', strtotime($event->start_time)) : null;
            $end_time = isset($event->end_time) ? date('h:i A', strtotime($event->end_time)) : null;
            
            $formattedEvents[] = [
                'eventDate' => $event->eventDate,
                'event_name' => $event->event_name,
                'description' => $event->description,
                'cover_images' => $event->cover_images,
                'start_time' => $start_time,
                'end_time' => $end_time
            ];
        }
        
        $data['events'] = $formattedEvents;
        $this->view('eventPlanner/calendar',$data);
    }

    private function getCreatedEvent($id,$event){
        $res = $event->getEventsByUserId($id);
        return $res;
    }
}