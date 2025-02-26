<?php 

class AdminTicketReport {
    use Controller;

    public function index()
    {
        $ticket = new Ticket;
        $data =[];
        $data['ticket'] = $this->displayTicketReport($ticket);
        //show($data['ticket']);
        $this->view('admin/ticketreport',$data);
    }

  
    public function displayTicketReport($ticket)
    {
        
        return  $ticket->getEventTicketDetails();

        
    }

}