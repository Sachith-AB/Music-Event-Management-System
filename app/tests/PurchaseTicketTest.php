<?php declare(strict_types=1);

// require_once __DIR__ . '/../../vendor/autoload.php';

use PHPUnit\Framework\TestCase;

class PurchaseTicketTest extends TestCase
{
    public function testCreatePurchaseReturnsNullOnSuccess()
    {
        $controller = new Purchaseticket();

        $mockBuyticket = $this->createMock(Buyticket::class);
        $mockBuyticket->method('validePurchase')->willReturn(true);
        $mockBuyticket->method('insert')->willReturn(true);

        $mockTicket = $this->createMock(Ticket::class);
        $mockTicket->method('decreaseQuantity')->willReturn(true);

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

        $result = $controller->createPurchase($purchaseData, $mockBuyticket);
        $this->assertNull($result);
    }
}
