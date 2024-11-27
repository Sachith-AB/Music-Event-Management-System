<?php 

class EventPlanners {

    use Controller;
    use Model;

    public function index()
    {
        $this->view('admin/eventplaners');

    }

   
}