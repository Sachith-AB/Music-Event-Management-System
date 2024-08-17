<?php

class Create {

    use Controller;
    use Model;
    public function index() {

        echo "This is the event controllers";
        $this->view('event/createEvent');
       
    }
}