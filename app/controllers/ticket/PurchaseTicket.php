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
            // Assuming $_SESSION['USER'] holds the logged-in user's details, including ID
            $userId = $_SESSION['USER']->id;


            $ticket = new Ticket();
            $ticketDetails = $ticket->getTicketAndEventDetails($ticket_id);
             //show($data);

            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
                $firstName = $_POST['first-name'] ?? null;
                $lastName = $_POST['last-name'] ?? null;
                $email = $_POST['email'] ?? null;
                $phone = $_POST['phone'] ?? null;
                $ticketQuantity = $_POST['ticketCount'] ?? 1;
                $availableQuantity = $_POST['availableticketcount'];
                $eventId = $ticketDetails[0]->event_id ?? null;  // Adjust based on how event ID is stored in ticketdetails
            
                // if (empty($firstName) || empty($lastName) || empty($email) || empty($phone)) {
                //     echo "Please fill in all required fields.";
                //     return;
                // }
            
                // if ($ticketDetails[0]->ticket_quantity < $ticketQuantity) {
                //     echo "Not enough tickets available.";
                //     return;
                // }
            
                $purchaseData = [
                    'user_id' => $userId,
                    'ticket_id' => $ticket_id,
                    'buyer_Fname' => $firstName,
                    'buyer_Lname' => $lastName,
                    'buyer_phoneNo' => $phone,
                    'buyer_email' => $email,
                    'event_id' => $eventId,
                    'payment_status' => 'pending',
                    'ticket_quantity' => $ticketQuantity,
                    'available_quantity' => $availableQuantity,
                    'buy_time' => date('Y-m-d H:i:s'),
                ];
                $data = $this->createPurchase($purchaseData, $buyticket, $ticketDetails);
            
                if(empty($data)){
                    $latestpurchaseid = $buyticket->getLatestInsertedId();
                    $totalFee = $ticketDetails[0]->ticket_price*$ticketQuantity;

                    // Redirect to PayHere
                    $merchantId = '1229373';
                    $returnUrl = ROOT . '/successfullypaid?purchase_id=' . $latestpurchaseid . '&email=' . $email;
                    $cancelUrl = ROOT . '/payment-failure?id='.$eventId;
                    $notifyUrl = ROOT . '/PaymentNotify';
                    $merchant_secret='MTk2MTI2MTY0MzQ3ODM5NjY0MzU0ODYwNjE5OTEzODAzMTkzOTc=';
                    $currency = "LKR";
                    // $order_id = random_int(10000,999999);
                    $order_id = $latestpurchaseid;

                    $hash = strtoupper(
                        md5(
                            $merchantId . 
                            $order_id. 
                            //chnage this with total amount
                            number_format($totalFee, 2, '.', '') . 
                            $currency .  
                            strtoupper(md5($merchant_secret)) 
                        ) 
                    );


                    echo '<form id="paymentForm" method="POST" action="https://sandbox.payhere.lk/pay/checkout">
                        <input type="hidden" name="merchant_id" value="' . $merchantId . '">
                        <input type="hidden" name="return_url" value="' . $returnUrl . '">
                        <input type="hidden" name="cancel_url" value="' . $cancelUrl . '">
                        <input type="hidden" name="notify_url" value="' . $notifyUrl . '">
                        <input type="hidden" name="first_name" value="' . $firstName . '">
                        <input type="hidden" name="last_name" value="' . $lastName . '">
                        <input type="hidden" name="email" value="' . $email . '">
                        <input type="hidden" name="phone" value="' . $phone . '">
                        <input type="hidden" name="address" value="">
                        <input type="hidden" name="city" value=" Colombo "> 
                        <input type="hidden" name="country" value="LK">
                        <input type="hidden" name="order_id" value="' . $order_id . '">
                        <input type="hidden" name="items" value="Appointment Payment">
                        <input type="hidden" name="currency" value="'.$currency.'">
                        <input type="hidden" name="amount" value="' . $totalFee . '">
                        <input type="hidden" name="hash" value="' . $hash . '">
                        <!-- <button type="submit">Pay now</button> -->
                    </form>
                    <script>
                        document.getElementById("paymentForm").submit();
                    </script>
                    ';






            

                    //redirect("successfullypaid?purchase_id=$latestpurchaseid");
                    //redirect("successfullypaid?purchase_id=$latestpurchaseid&email=$email");

                }
            }
            $event = new Event();
            $recevtevents = $event->getRecentEvents(4);
            // show($recevtevents);

            $this->view('ticket/purchaseticket', ['ticket_id' => $ticket_id, 'ticketdetails'=> $ticketDetails,'recentevents' => $recevtevents, 'data'=>$data ?? null]);
        } else {
            // Handle cases where 'id' is missing in the URL
            echo "Ticket ID not specified in the URL.";
        }
        
    }

    public function createPurchase($purchaseData,$buyticket)
    {
        
        if($buyticket->validePurchase($purchaseData)){
            
            $buyticket->insert($purchaseData);
            // If the purchase was successful, decrease the ticket quantity
            $ticket = new Ticket();
            $ticket->decreaseQuantity($purchaseData['ticket_id'], $purchaseData['ticket_quantity']);
        }
        else{
            return $buyticket->errors;
        }
    }
    
}   