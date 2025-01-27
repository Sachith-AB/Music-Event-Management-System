<?php 

class EventPlannerCompletedEvent {
    use Controller;
    use Model;


    public function index()
    {

        $event = new Event;
        $ticket = new Ticket;
        $payment = new Payment;
        $data =[];

        $event_id = htmlspecialchars($_GET['id']);

        $row = $event->firstById($event_id);
        //show($row);

        $data1 = $this->getData($row);

        $total_income = $this->ticketIncome($ticket, $event_id);
        //show($total_income);

        $ticket_count_data = $this->getAllTicketCount($ticket, $event_id);
        //show($ticket_count_data);

        $data2= array_merge($total_income, $ticket_count_data);

        $payment_data = $this->getPaymentData($payment, $event_id);
        //show($payment_data);

        $performers = $this->getPerformers($event);
        //show($performers);

        $data = array_merge($data1, $data2, $payment_data, $performers);

        $this->view('eventPlanner/completedEvent', $data);
    }

    public function getData($row) {
        $data['event'] = $row;
        return $data;
    }



    public function ticketIncome($ticket, $id) {
        // Fetch income details grouped by date
        $income_over_time = $ticket->getTicketIncomeOverTime($id);

        $total_income = 0;  
        
        foreach ($income_over_time as $record) {
            $total_income += $record->total_income;  
            //show($total_income);
        }

        // Return income data with total
        return [
            'total_income' => $total_income,  
        ];
    }

    public function getAllTicketCount($ticket, $id) {
        // Fetch ticket types and their progress
        $ticket_count = $ticket->getPurchasedTicketCounts($id);


        $total_tickets = 0;
        $sold_tickets = 0;

        foreach ($ticket_count as $ticket_info) {
            $total_tickets += $ticket_info->quantity + $ticket_info->sold_quantity;
            $sold_tickets += $ticket_info->sold_quantity;
            //show($total_tickets);
            //show($sold_tickets);
        }

        // Return ticket progress data
        return [
            'total_tickets' => $total_tickets,
            'sold_tickets' => $sold_tickets,
        ];
    }

    public function getPaymentData($payment, $id) {
        $total_payment = $payment->getPaymentData($id);

        $total_cost = 0;
        foreach ($total_payment as $record) {
            $total_cost  += $record->total_payment; 
        }
    
        return ['total_cost' => $total_cost];
    }

    public function getPerformers($event) {
        $id = htmlspecialchars($_GET['id']);
        $res = $event->getAllEventData($id);
        //show($res);
        return $res;
    }
}

?>