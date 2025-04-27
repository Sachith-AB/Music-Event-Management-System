<?php 

class AdminDashboard {

    use Controller;
    use Model;

    public function index()
    {
        $event = new Event;
        $notification = new Notification;
        $data = [];

        $data['processing'] = $this->displayProcessingEvents($event);
        // show($data['upcoming']);

        $data['held'] = $this->displayAlreadyHeldEvents($event);
        // show($data['held']);

        $data['scheduled'] = $this->displayScheduledEvents($event);
        //show($data['scheduled']);
        // echo json_encode($data['upcoming']);

        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['is_delete'])){
            // show($_POST);
            $this->deleteEvent($event);
            $this->deleteNotification($event,$notification);
            redirect('admin-dashboard');
        }


        $this->view('admin/admindashboard',$data);

    }



    public function displayProcessingEvents($event)
    {
    //    $offset = isset($_GET['offset']) ? intval($_GET['offset']) : 0;
    //    $limit = 6;
    
        $res = $event->getProcessingEvents();
        return $res;

    }

    public function displayAlreadyHeldEvents($event)
    {

        $res = $event->getAlreadyHeldEvents();
        return $res;
    }

    public function displayScheduledEvents($event)
    {
        $res = $event->getScheduledEvents();
        return $res;
    }


    private function deleteEvent($event) {

        $id = $_POST['event_id'];
        $event->update($id, $_POST);

        // $data = $event->firstById($_POST['event_id']);
        // $data = json_decode(json_encode($data),true);
        // $data['event_id'] = $data['id'];
        // // show($data);

        // $deletedEvent->insert($data);
        // $event->delete($_POST['event_id']);

        // redirect('admin-dashboard');
    }

    private function deleteNotification($event,$notification) {
        $eventid = $_POST['event_id'];
        $eventDetails = $event->firstById($eventid);
        $changes[] = "your event {$eventDetails->event_name} has been deleted by the admin";
        $link = "event-planner-myevents";
        $notifymsg = [
            'user_id' => $eventDetails->createdBy,
            'title' => "Your event {$eventDetails->event_name} has been deleted",
            'message' => json_encode($changes),
            'is_read' => 0,
            'link' => $link,
        ];
        $notification->insert($notifymsg);
    }
}