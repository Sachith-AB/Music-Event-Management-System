<?php 

class EventPlannerViewEvent {

    use Controller;
    use Model;

   
    public function index()
    {
        $event = new Event;
        $request = new Request;
        $data = [];

        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['schedule']))
        {
            // show($_POST['id']);
            $this->updateEventStatus($event);
        }

        $data = $this->getEventDetails($event);

        $data['requests'] = $this->getRequestForEventPage($request);
        // show($data);
        

        $this->view('eventPlanner/eventView',$data);


    }


    public function getEventDetails($event)
    {
        $id = $_GET['id'];
        $res =  $event->getAllEventData($id);

        return $res;

    }

    public function getRequestForEventPage($request)
    {
        $id = $_GET['id'];
        $res = $request->getCollaboratorRequests($id);

        return $res;
    }

    public function updateEventStatus($event)
    {
            $id = $_POST['id'];
            // show($_POST);
            $event->update($id,$_POST);
            redirect('event-planner-myevents');
    }

   
}