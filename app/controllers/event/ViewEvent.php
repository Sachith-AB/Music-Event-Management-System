<?php 
class ViewEvent{

    use Controller;
    use Model;

    public function index(){

        $data =[];
        $event = new Event;
        $data = $this->getEventData($event);

        $this->view('event/viewEvent',$data);
    }

    public function getEventData($event){
        $id = htmlspecialchars($_GET['id']);
        $res = $event->getAllEventData($id);
        return $res;
    }
}