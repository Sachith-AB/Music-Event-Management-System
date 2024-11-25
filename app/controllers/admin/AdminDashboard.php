<?php 

class AdminDashboard {

    use Controller;
    use Model;

    public function index()
    {
        $this->view('admin/admindashboard');

    }

   
}