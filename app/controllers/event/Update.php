<?php

class Update {

    use Controller;
    use Model;

    public function index () {

        $event = new Event;
        $data = [];
        $success = '';

        $event_name = htmlspecialchars($_GET['event_name']);
        $row = $event->firstByEventName($event_name);
        // show($row);


        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])){
            
            $data['error'] = $this->updateDetail($event);
        }
        // if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['upload'])){
        //     $this->uploadImages($event,$_FILES);
        //     show($_FILES);
        // }

        $data ['event'] = $this->getData($row);
        $this->view('event/updateEvent',$data);
    }

    public function getData($row) {

        $data = json_decode(json_encode($row),true);
        return $data;
    }

    public function updateDetail($event) {

        $event_name = $_POST['event_name'];
        //Pass message
        $msg = "Event updated Succesfully";
        $success = 'flag=' . 2 . '&msg=' . $msg . '&success_no=' . 1;

        //Update event
        if($event->validEventUpdate($_POST)){
            $event->update($_POST['event_id'], $_POST);
            unset($POST['update']);
            redirect("event-review?event_name=$event_name");

        }else{
            return ['success' => false, 'errors' => $event->errors];
        }

        // show($_POST);

        
       
    }

   
    
}

