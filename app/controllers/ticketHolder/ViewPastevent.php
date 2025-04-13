<?php 
class ViewPastevent{

    use Controller;
    use Model;

    public function index(){

        $data =[];
        $event = new Event;
        $rating = new Rating;
        $id = htmlspecialchars($_GET['id']);

        $data = $this->getEventData($event,$id);
        
        
        if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['review'])){
            $this->reivewEvent($rating,$id);
        }

        $this->view('ticketholder/viewPastevent',$data);
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
}