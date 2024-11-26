<?php

class Calender {
    use Controller;

    public function index(){
        $this->view('eventCollaborator/calender');
    }
}