<?php 

class AdminEventReport {
    use Controller;

    public function index()
    {
        $event = new Event;
        $data = [];

        $data['upcoming'] = $this->displayUpcomingEvents($event);
        //show($data['upcoming']);
        $data['PastEvent'] = $this->displayPastEvents($event);
        //show($data['PastEvent']);
        
        // Fetch all planners
        $data['planners'] = $event->getUsers();
        
        $this->view('admin/eventreport', $data);
    }

    public function displayUpcomingEvents($event)
    {
        return $event->getfullFutureEventInfo();
    }

    public function displayPastEvents($event)
    {
        return $event->getFullPastEventInfoWithTickets();
    }

}