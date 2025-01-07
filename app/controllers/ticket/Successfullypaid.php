<?php

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

class Successfullypaid {

    use Controller;
    use Model;
    public function index() {

        $buyticket = new Buyticket();

        if($_SERVER['REQUEST_METHOD']==="POST" && isset ($_POST["submit"])){
            $this->sendEmail();
            show($_POST);

        }

        $purchase_id = isset($_GET['purchase_id']) ? $_GET['purchase_id'] : null;
        $purchaseDetails = $buyticket->getPurchaseDetails($purchase_id);

        $ticket = new Ticket();
        $eventAndTicketDetails = $ticket->getTicketAndEventDetails($purchaseDetails[0]->ticket_id);

        $event = new Event();
        $recevtevents = $event->getRecentEvents(4);


        $this->view('ticket/successfullypaid', ['purchaseDetails' => $purchaseDetails, 'eventAndTicketDetails'=> $eventAndTicketDetails,'recentevents' => $recevtevents]);
    }

    public function sendEmail()
    {
        $mail = new PHPMailer\PHPMailer\PHPMailer(true);

        try {
            // SMTP configuration
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'sathruwanihapuarachchi7@gmail.com';
            $mail->Password = 'kbgrqiybaflylgnr'; // Store this securely
            $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;

            // Set email details
            $mail->setFrom('sathruwanihapuarachchi7@gmail.com', 'Musicia');
            $mail->addAddress($_POST['email']);

            $mail->isHTML(true);
            $mail->Subject = "Your Ticket Purchase Details";

            // Generate the email body
            $emailBody = "<h1>Thank you for your purchase, " . htmlspecialchars($_POST['first-name']) . " " . htmlspecialchars($_POST['last-name']) . "!</h1>";
            $emailBody .= "<p>You have successfully purchased " . htmlspecialchars($_POST['ticketCount']) . " ticket(s) for:</p>";
            $emailBody .= "<ul>";
            $emailBody .= "<li><strong>Event:</strong> " . htmlspecialchars($_POST['eventname']) . "</li>";
            $emailBody .= "<li><strong>Date:</strong> " . htmlspecialchars(date("l, F d, Y h:i A", strtotime($_POST['eventdate']))) . "</li>";
            $emailBody .= "<li><strong>Location:</strong> " . htmlspecialchars($_POST['address']) . "</li>";
            $emailBody .= "</ul>";

            // Add tickets with QR codes
            $emailBody .= "<h2>Your Tickets:</h2>";
            for ($i = 0; $i < $_POST['ticketCount']; $i++) {
                $qrData = [
                    'ticket_number' => $_POST['ticketCount'] + ($i + 1),
                    'event_name' => $_POST['eventname']
                ];
                $qrCodeUrl = "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=" . urlencode(json_encode($qrData));

                $emailBody .= "<div style='margin-bottom: 20px;'>";
                $emailBody .= "<p><strong>Ticket " . ($i + 1) . ":</strong></p>";
                $emailBody .= "<img src='" . htmlspecialchars($qrCodeUrl) . "' alt='QR Code for Ticket " . ($i + 1) . "' style='width: 150px; height: 150px;'/>";
                $emailBody .= "</div>";
            }

            $emailBody .= "<p>Enjoy the event!</p>";

            // Set email format to HTML
            $mail->Body = $emailBody;

            // Send the email
            $mail->send();
            redirect("home");
        } catch (Exception $e) {
            echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}