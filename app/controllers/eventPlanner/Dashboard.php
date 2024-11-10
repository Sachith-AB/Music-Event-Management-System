<?php

class Dashboard {

    use Controller;

    public function index () {
        $this->view('eventPlanner/dashoverview');
    }
    public function createdevent () {
        $this->view('eventPlanner/dashcreatedevent');
    }
    public function profile () {
        $this->view('eventPlanner/dashprofile');
    }
    public function payment () {
        $this->view('eventPlanner/dashpayment');
    }
}
