<?php

class Profile {

    use Controller;

    public function index () {
        $this->view('eventPlanner/profile');
    }
}
