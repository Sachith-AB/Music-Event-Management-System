<?php 

class EventDetails {

    use Controller;
    use Model;

    public function index()
    {
        $sender_id = $_GET['sender_id'] ?? null;
        $data =[];
        $event = new Event;
        $user=new User;
        $data = $this->getEventData($event);

        // show($data);

        $array['id'] = htmlspecialchars($data['event']->createdBy);
        $eventplanner = $user->first($array);
        // show($_SESSION['USER']);
        // show($eventplanner);
        $userrole = $_SESSION['USER']->role;
        $this->view('eventCollaborator/eventDetails',['data'=>$data,'eventplanner'=>$eventplanner,'userrole'=>$userrole]);

    }

    public function getEventData($event){
        $id = htmlspecialchars($_GET['event_id']);
        $res = $event->getAllEventData($id);
        return $res;
    }
   
}