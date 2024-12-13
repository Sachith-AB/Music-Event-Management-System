<?php 

class TicketHolders {

    use Controller;
    use Model;

    public function index()
    {
        $event = new Event;
        $data = [];

        $data = $this->getHolderDetails($event);
        // show($data);
        $this->view('admin/ticketholders', $data);

    }

    public function getHolderDetails($event)
    {
        $res = $event->getUsers();
        return $res;
    }

   
}