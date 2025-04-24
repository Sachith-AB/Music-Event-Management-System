<?php
use PHPUnit\Framework\TestCase;

// Stub traits so PHP doesn't throw errors
require_once 'tests/stubs/Controller.php';
require_once 'tests/stubs/Model.php';

// Fake model dependencies
require_once 'tests/fakes/FakeBuyticket.php';
require_once 'tests/fakes/FakeTicket.php';

// Load the controller under test
require_once 'app/controllers/ticket/Purchaseticket.php';

class PurchaseTicketTest extends TestCase
{
    public function testCreatePurchaseReturnsNullOnSuccess()
    {
        $controller = new Purchaseticket();

        $purchaseData = [
            'user_id' => 1,
            'ticket_id' => 1,
            'buyer_Fname' => 'Test',
            'buyer_Lname' => 'User',
            'buyer_phoneNo' => '94712345678',
            'buyer_email' => 'test@example.com',
            'event_id' => 5,
            'payment_status' => 'pending',
            'ticket_quantity' => 2,
            'available_quantity' => 10,
            'buy_time' => date('Y-m-d H:i:s'),
        ];

        $buyticket = new Buyticket(); // fake
        $result = $controller->createPurchase($purchaseData, $buyticket);

        $this->assertNull($result);
    }
}
