<?php 

class TicketHolders {

    use Controller;
    use Model;

    public function index()
    {
        $this->view('admin/ticketholders');

    }

   
}