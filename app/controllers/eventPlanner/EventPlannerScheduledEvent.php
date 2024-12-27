<?php

class EventPlannerScheduledEvent {

    use Controller;
    use Model;

    public function index() {
        $ticket = new Ticket;
        $event = new Event;

        $payment = new Payment;

        $data = [];
        $event_id = htmlspecialchars($_GET['id']); // Get event ID from the URL

        $row = $event->firstById($event_id);
       // show($row);

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
            $event_id = htmlspecialchars($_GET['id']);

            //show($event_id);

            show($event_id);

            show($_POST);
            $this->updateDetail($event,$event_id);
        }

        $data1= $this->getData($row);

        // Fetch income and ticket count progress
        $income_data = $this->ticketIncome($ticket, $event_id);
        $ticket_count_data = $this->getAllTicketCount($ticket, $event_id);

        // Combine all data to pass to the view
        $data2= array_merge($income_data, $ticket_count_data);
        $data = array_merge($data1, $data2);

        $this->view('eventPlanner/scheduledEvent', $data);
    }

    public function getData($row) {
        $data = json_decode(json_encode($row), true);
        return $data;
    }

    public function updateDetail($event, $event_id) {
        // Message for feedback (optional)
        $msg = "Event updated successfully";
    
        // Sanitize and validate POST data
        $updateData = [
            'event_date' => $_POST['event_date'] ?? null,
            'start_time' => isset($_POST['starttime']) ? date('H:i:s', strtotime($_POST['starttime'])) : null,
            'end_time' => isset($_POST['endtime']) ? date('H:i:s', strtotime($_POST['endtime'])) : null,
        ];
    
        // Filter out null values to avoid overwriting with empty fields
        $filteredData = array_filter($updateData, function ($value) {
            return $value !== null;
        });
    

        

        // Debugging: Show the data being sent to the update method
        show($filteredData);
    

        // Check if there's data to update
        if (!empty($filteredData)) {
            $event->update($event_id, $filteredData);
        } else {
            $msg = "No valid data to update";
        }
    }
    
    

    public function ticketIncome($ticket, $id) {
        // Fetch income details grouped by date
        $income_over_time = $ticket->getTicketIncomeOverTime($id);

        // Format data for the chart
        $dates = [];
        $incomes = [];
        
        foreach ($income_over_time as $record) {
            $dates[] = $record->purchase_date;
            $incomes[] = $record->total_income;
        }

        // Return income data
        return [
            'dates' => $dates,
            'incomes' => $incomes,
        ];
    }

    public function getAllTicketCount($ticket, $id) {
        // Fetch ticket types and their progress
        $ticket_count = $ticket->getPurchasedTicketCounts($id);

        // Format the ticket progress data
        $ticket_types = [];
        $total_tickets = [];
        $sold_tickets = [];

        foreach ($ticket_count as $ticket_info) {
            $ticket_types[] = $ticket_info->ticket_type;
            $total_tickets[] = $ticket_info->quantity + $ticket_info->sold_quantity;
            $sold_tickets[] = $ticket_info->sold_quantity;
        }

        // Return ticket progress data
        return [
            'ticket_types' => $ticket_types,
            'total_tickets' => $total_tickets,
            'sold_tickets' => $sold_tickets,
        ];
    }
}
