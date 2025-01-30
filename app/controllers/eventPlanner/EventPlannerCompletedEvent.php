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
        //show($data2);

        $payment_data = $this->getPaymentData($payment, $event_id);
        //show($payment_data);

        $performers = $this->getPerformers($event);
        //show($performers);

        $data = array_merge($data1, $data2,$payment_data, $performers);
        //show($data);
        $this->view('eventPlanner/completedEvent', $data);
    }

    public function getData($row) {
        $data['event'] = $row;
        return $data;
    }

    private function numToPrice($num) {
        return number_format($num, 2, '.', ',');
    }


    public function ticketIncome($ticket, $id) {
        // Fetch income details grouped by date
        $income_over_time = $ticket->getTicketIncomeOverTime($id);

        $total_income = 0.0;  
        
        foreach ($income_over_time as $record) {
            $total_income += $record->total_income;  
            $record_data[] = $record;
            //show($record_data); 
        }

        // Return income data with total
        return [
            'total_income' => $this->numToPrice($total_income),  
            'record' => $record_data
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
            $ticket_types[] = [
                'type' => $ticket_info->ticket_type,
                'quantity' => $ticket_info->quantity,
                'sold_quantity' => $ticket_info->sold_quantity
            ];
            

            //show($ticket_info->quantity);
            //show($ticket_info->ticket_type);

            //show($total_tickets);
            //show($sold_tickets);
        }

        // Return ticket progress data
        return [
            'total_tickets' => $total_tickets,
            'sold_tickets' => $sold_tickets,
            'ticket_types' => $ticket_types
        ];
    }

    public function getPaymentData($payment, $id) {
        $total_payment = $payment->getPaymentData($id);
        $total_cost = 0;
        foreach ($total_payment as $record1) {
            $total_cost  += $record1->total_payment; 
            $record_data[] = $record1;
            //show($record_data);   
        }
       
    
        return ['total_cost' => $total_cost,
                'record1' => $record_data];
        
    }

    public function getPerformers($event) {
        $id = htmlspecialchars($_GET['id']);
        $res = $event->getAllEventData($id);
        //show($res);
        return $res;
    }
}

?>