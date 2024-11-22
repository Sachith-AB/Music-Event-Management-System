<?php



class Purchaseticket {

    use Controller;
    use Model;

    public function index() {

        $buyticket = new Buyticket();

        $ticket_id = isset($_GET['id']) ? $_GET['id'] : null;

        // if($_SERVER['REQUEST_METHOD']==="POST" && isset ($_POST["submit"])){
        //     $this->sendEmail();
        //     show($_POST);

        // }

        if ($ticket_id) {
            if (!$this->isLoggedIn()) {
                redirect('signin');
                exit();
            }
    
            // Assuming $_SESSION['USER'] holds the logged-in user's details, including ID
            $userId = $_SESSION['USER']->id;


            $ticket = new Ticket();
            $data = $ticket->getTicketAndEventDetails($ticket_id);
            // show($data);

            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
                $firstName = $_POST['first-name'] ?? null;
                $lastName = $_POST['last-name'] ?? null;
                $email = $_POST['email'] ?? null;
                $phone = $_POST['phone'] ?? null;
                $ticketQuantity = $_POST['ticketCount'] ?? 1;
                $eventId = $data[0]->event_id ?? null;  // Adjust based on how event ID is stored in ticketdetails
            
                if (empty($firstName) || empty($lastName) || empty($email) || empty($phone)) {
                    echo "Please fill in all required fields.";
                    return;
                }
            
                if ($data[0]->ticket_quantity < $ticketQuantity) {
                    echo "Not enough tickets available.";
                    return;
                }
            
                $purchaseData = [
                    'user_id' => $userId,
                    'ticket_id' => $ticket_id,
                    'buyer_Fname' => $firstName,
                    'buyer_Lname' => $lastName,
                    'buyer_phoneNo' => $phone,
                    'buyer_email' => $email,
                    'event_id' => $eventId,
                    'ticket_quantity' => $ticketQuantity,
                    'buy_time' => date('Y-m-d H:i:s'),
                ];
            
                $this->createPurchase($purchaseData, $buyticket, $data);
                $latestpurchaseid = $buyticket->getLatestInsertedId();
        
                redirect("successfullypaid?purchase_id=$latestpurchaseid");
            }
            

            

            $event = new Event();
            $recevtevents = $event->getRecentEvents(4);
            // show($recevtevents);

            $this->view('ticket/purchaseticket', ['ticket_id' => $ticket_id, 'ticketdetails'=> $data,'recentevents' => $recevtevents]);
        } else {
            // Handle cases where 'id' is missing in the URL
            echo "Ticket ID not specified in the URL.";
        }
        
       
    }

    public function createPurchase($purchaseData,$buyticket)
    {

        $result = $buyticket->insert($purchaseData);
        show($result);

       
            // If the purchase was successful, decrease the ticket quantity
        $ticket = new Ticket();
        $ticket->decreaseQuantity($purchaseData['ticket_id'], $purchaseData['ticket_quantity']);
      
        
        
        return $result;
    }
    
}   