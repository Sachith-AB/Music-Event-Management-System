<?php 

class SingerCalendar {

    use Controller;
    use Model;

    public function index()
    {
        $this->view('eventCollaborator/singercalendar');

    }

   
}