<?php 

class DecoratorsRequest {

    use Controller;
    public function index() {


        $request = new Request;
        $event = new Event;
        $calendar = new Calendar;
        $notification = new Notification;
        $data = [];

        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['request'])) {

            $event_data = $event->firstById($_POST['event_id']);

            if(!$this->checkAvailability($calendar, $_POST['collaborator_id'], $event_data->eventDate))
            {
                $error = "Collaborator is not available on this date";
                $errorParams = 'flag=1&error=' . urlencode($error) . '&error_no=1';
                redirect('request-bands?id='.$_POST['event_id'].'&'.$errorParams);
            }
            else
            {
                $this->createRequest($request);
                $this->createNotification($event,$notification,$_POST);
            }
            
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['deleteRequest'])){

            $this->deleteRequest($request);
        }

        if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['searchDecorators'])){
            
            
            $data['users'] = $this->searchUsers($request);
            // show($data);
            // show($_POST);
        }else{
            $data['users'] = $this->getUsers($request);
        }


        $data['requests'] = $this->getExistingRequest($request);

        
        $this->view('request/decoratorsRequest', $data);

        // show($data);

    }


    public function getUsers($request)
    {
        $data = $request->getUsersByRole('decorator','profile');
        return $data;

    }

    public function createRequest($request)
    {

    $res =  $request->insert($_POST);
    return $res;

    }

    public function searchUsers($request){
        
        $res = $request->searchByTerm($_POST , 'decorator' , 'profile');
        // show($res);
        unset($_POST['searchTerm']);
        unset($_POST['search']);
        return $res;
    }   

    public function getExistingRequest($request)
    {
        $id = htmlspecialchars($_GET['id']);

        $result = $request->getExistingRequests($id,'decorator');

        return $result;
    }

    public function deleteRequest($request){

        //show($_POST['req_id']);
        $request->delete($_POST['req_id']);
        unset($_POST);
    }

    public function createNotification($event,$notification,$post){
        $eventDetails = $event->firstById($post['event_id']);
        $changes[] = "Event name: '{$eventDetails->event_name}' Event Date: '{$eventDetails->eventDate}'";
        $link = "colloborator-request";
        $notifymsg = [
            'user_id' => $post['collaborator_id'],
            'title' => "Recieved a request",
            'message' => json_encode($changes),
            'is_read' => 0,
            'link' => $link,
        ];
        $notification->insert($notifymsg);
    }

    private function checkAvailability($calendar, $user_id, $event_date)
    {
        return $calendar->getAvailability($user_id, $event_date);
    }

}