<?php

class EventPlannerPayment {

    use Controller;

    public function index () {
        $this->view('eventPlanner/payment');
    }
}