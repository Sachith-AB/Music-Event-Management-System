<?php 

class Calender {

    use Controller;

    public function index() {

        $this->view('calender/calender');
    }
}