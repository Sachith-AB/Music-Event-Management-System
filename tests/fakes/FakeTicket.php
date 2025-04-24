// tests/fakes/FakeTicket.php
<?php
class Ticket
{
    public function getTicketAndEventDetails($ticketId)
    {
        return [(object)[
            'event_id' => 10,
            'ticket_price' => 1000,
            'ticket_quantity' => 20,
        ]];
    }

    public function decreaseQuantity($ticketId, $quantity)
    {
        // Simulate update
    }
}
