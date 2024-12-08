<?php 

class EventDetails {

    use Controller;
    use Model;

    public function index()
    {
        
        $data =[];
        $event = new Event;
        $user=new User;
        $data = $this->getEventData($event);

        // show($data);

        $array['id'] = htmlspecialchars($data['event']->createdBy);
        $eventplanner = $user->first($array);
        // show($eventplanner);
        $this->view('eventCollaborator/eventDetails',['data'=>$data,'eventplanner'=>$eventplanner]);

    }

    public function getEventData($event){
        $id = htmlspecialchars($_GET['event_id']);
        $res = $event->getAllEventData($id);
        return $res;
    }
   
}