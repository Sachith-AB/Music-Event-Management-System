<?php

class Successfullypaid {

    use Controller;
    use Model;
    public function index() {

        $this->view('ticket/successfullypaid');
    }
}