<?php 

class SingerProfile {

    use Controller;
    use Model;

    public function index()
    {
        $this->view('eventCollaborator/singerProfile');

    }

   
}