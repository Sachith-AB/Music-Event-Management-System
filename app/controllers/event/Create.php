
<?php

class Create {

    use Controller;

    public function index() {
        $event = new Event;
        $data = [];


        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
            //show($_POST);

            $data = $this->create($event,$_POST);
            // show($data);
        }


        $this->view('event/createEvent',$data);

        

    }

    private function create($event, $POST){
        $event_name = $POST['event_name'];
        if($event->validEvent($_POST)){
            $array['event_name'] = $event_name;
            $row = $event->first($array);

            if($row == 0){
                unset($POST['submit']); //remove submit key from POST array
                $event->insert($_POST);
                //show($event_name);
                //show ($_POST);
                redirect("event-review?event_name=$event_name");


            }else{
                $error = "Event name is already taken";
                $errors = 'flag=' . 1 . '&error=' . $error . '&error_no=' . 7 ;
                redirect("create-event?$errors");
                exit;
            }
        }else{
            return $event->errors;
        }

    }
}
