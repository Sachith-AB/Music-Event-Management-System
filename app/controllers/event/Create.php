<?php


class Create {

    use Controller;

    public function index() {
        $event = new Event;
        $data = [];

        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit']))
        {
            $data = $this -> create($event,$_POST);
        }


         $this->view('event/createEvent',$data);
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
