<?php

class Create {

    use Controller;

    public function index() {
        $event = new Event;
        $data = [];

        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
            show($_POST);

            $data = $this->create($event,$_POST);
            show($data);
        }


        $this->view('event/createEvent',$data);
        header("Location: /event/review");
        

    }

    private function create($event, $POST){

        if($event->validEvent($_POST)){

            unset($POST['submit']);
            $event->insert($_POST);

        }else{
            return $event->errors;
        }

    }
}
