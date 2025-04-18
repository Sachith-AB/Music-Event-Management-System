<?php 
class NotificationEvent{

    use Controller;
    use Model;

    public function index(){

        $data =[];
        $event = new Event;
        $rating = new Rating;
        $eventcomment = new Eventcomments;

        $event_id = htmlspecialchars($_GET['id']);

        $data = $this->getEventData($event,$event_id);
        $data["eventplanner"] = $this->getEventPlanner($event,$event_id);
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_comment'])) {
            // show($_POST);
            $this->addComment($event_id, $eventcomment, $_POST);
            redirect("view-pastevent?id=" . $event_id);
            
        }

        $commentsForEvent = $eventcomment->getCommnet($event_id);
        
        if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['review'])){
            $this->reivewEvent($rating,$event_id);
        }

        $this->view('ticketholder/notificationEvent',['data'=>$data,'commentsForEvent'=>$commentsForEvent]);
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
    public function getEventPlanner($event, $id){
        $res = $event->geteventplannerinfo($id);
        return $res;
    }
    public function addComment($event_id, $eventcommnet, $comment) {
        // Prepare data for insertion
        $data = [
            'event_id' => $event_id,
            'user_id' => htmlspecialchars($comment['user_id']),
            'comment' => htmlspecialchars($comment['content']),
            'created_at' => date('Y-m-d H:i:s')
        ];
        // Save comment
        $eventcommnet->insert($data);
    }

}