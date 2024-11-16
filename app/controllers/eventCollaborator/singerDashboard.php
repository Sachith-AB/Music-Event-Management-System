<?php 

class SingerDashboard {

    use Controller;
    use Model;

    public function index()
    {
        $this->view('eventCollaborator/singerdashboard');

    }

   
}