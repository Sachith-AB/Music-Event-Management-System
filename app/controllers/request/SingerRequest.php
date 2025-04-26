<?php 

class SingerRequest {

    use Controller;
    public function index() {


        $request = new Request;
        $calendar = new Calendar;
        $event = new Event;
        $data = [];

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['request'])) {
    
            $event_data = $event->firstById($_POST['event_id']);
        
            if (!$this->checkAvailability($calendar, $_POST['collaborator_id'], $event_data->eventDate)) {

                $error = "User is not available on this date";
                $errorParams = 'flag=1&error=' . urlencode($error) . '&error_no=1';
            
                redirect('request-singers?id=' . $_POST['event_id'] . '&' . $errorParams);
            
            } else {
                $this->createRequest($request);
            }
        }
        
        

        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['deleteRequest'])){

            $this->deleteRequest($request);
        }

        if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['searchSingers'])){
            
            
            $data['users'] = $this->searchUsers($request);

        }else{
            $data['users'] = $this->getUsers($request);
        }

        $data['requests'] = $this->getExistingRequest($request);

        $this->view('request/singerRequest', $data);


    }


    public function getUsers($request)
    {
        $data = $request->getUsersByRole('singer','profile');
        return $data;

    }

    public function createRequest($request)
    {

    $res =  $request->insert($_POST);
    return $res;

    }

    public function searchUsers($request){
        
        $res = $request->searchByTerm($_POST , 'singer' , 'profile');

        unset($_POST['searchTerm']);
        unset($_POST['search']);
        return $res;
    }   

    public function getExistingRequest($request){
        $id = htmlspecialchars($_GET['id']);

        $result = $request->getExistingRequests($id,'singer');

        return $result;
    }


    public function deleteRequest($request){

        $request->delete($_POST['req_id']);
        unset($_POST);
    }

    private function checkAvailability($calendar, $user_id, $event_date) {
        return $calendar->getAvailability($user_id, $event_date);
    }    

}