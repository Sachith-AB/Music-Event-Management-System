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
        //show($row);

        // if($_SERVER['REQUEST_METHOD'] === 'POST'  && $_FILES['city']['event_date'] != ''){
            
        //     unset($_POST['uploadImage']);
        //     $this->uploadImage($user,$_FILES,$id);
        // }

        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])){
            
            $this->updateDetail($event,$_POST,$event_name);
            //show($_POST);
        }
        $data = $this->getData($row);
        $this->view('event/updateEvent',$data);
    }

    public function getData($row) {

        $data = json_decode(json_encode($row),true);
        return $data;
    }

    public function updateDetail($event,$POST,$event_name) {

        //Pass message
        $msg = "Event Details updated Succesfully";
        $success = 'flag=' . 2 . '&msg=' . $msg . '&success_no=' . 1;

        //Update event
        $res = $event->update($event_name,$POST);
        unset($POST['update']);

        //Redirect to event review page
        redirect("event-review?event_name=$event_name&$success");
    }

}
