<?php

class Dashboard {

    use Controller;

    public function index () {
        $this->view('eventPlanner/dashboard');
    }
}
