<?php 

class SingerEvents {

    use Controller;
    use Model;

    public function index()
    {
        $this->view('eventCollaborator/singerFutureevents');

    }

   
}