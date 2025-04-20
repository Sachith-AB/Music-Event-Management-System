<?php

class EventPlannerCompletedEventInfo {
    use Controller;
    use Model;

    public function index () {

        $event = new Event();
        $data = [];

       $event_id = htmlspecialchars($_GET['id']);

       $row = $event->firstById($event_id);

       $data1 = $this->getData($row);

       $performers = $this->getPerformers($event);


       $comments = $this->getComments($event_id);

       $data = array_merge($data1, $performers, ['comments' => $comments]);

       //show($data);


        $this->view('eventPlanner/completedEventInfo', $data);
    }

    public function getData($row) {
        $data['event'] = $row;
        return $data;
    }

    public function getPerformers($event) {
        $id = htmlspecialchars($_GET['id']);
        $res = $event->getAllEventData($id);
        //show($res);
        return $res;
    }

    public function getComments($eventId) {
        $eventcomments = new Eventcomments();
        return $eventcomments->getCommnet($eventId);
    }
}



