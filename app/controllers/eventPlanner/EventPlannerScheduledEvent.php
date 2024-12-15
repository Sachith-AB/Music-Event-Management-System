<?php

class EventPlannerScheduledEvent {

    use Controller;
    use Model;

    public function index() {
        $ticket = new Ticket;
        $id = $_GET['id']; // Get event ID from the URL

        // Fetch income and ticket count progress
        $income_data = $this->ticketIncome($ticket, $id);
        $ticket_count_data = $this->getAllTicketCount($ticket, $id);

        // Combine all data to pass to the view
        $data = array_merge($income_data, $ticket_count_data);

        $this->view('eventPlanner/scheduledEvent', $data);
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
