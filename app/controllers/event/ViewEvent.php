<?php 
class ViewEvent{

    use Controller;
    use Model;

    public function index(){

        $data =[];
        $event = new Event;
        $rating = new Rating;
        $id = htmlspecialchars($_GET['id']);

        $data = $this->getEventData($event,$id);
        $data['rating']  = $this->getEventRating($rating,$id);
        //show($data);
        
        if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['review'])){
            $this->reivewEvent($rating,$id);
        }

        $this->view('event/viewEvent',$data);
    }

    public function getEventData($event,$id){
        
        $res = $event->getAllEventData($id);
        return $res;
    }

    private function reivewEvent($rating,$id){
        $_POST['event_id'] = $id;
        $_POST['user_id'] = $_SESSION['USER']->id;
        $rating->insert($_POST);

    }

    private function getEventRating($rating,$id){
        $res = $rating->getRatingFromEventId($id);
        return $res;
    }
}