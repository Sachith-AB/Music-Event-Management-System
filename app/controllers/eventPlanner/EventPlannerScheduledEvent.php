<?php

class EventPlannerScheduledEvent {

    use Controller;
    use Model;

    public function index() {
        $ticket = new Ticket;
        $event = new Event;
        $user = new User;
        $payment = new Payment;

        $data = [];
        $event_id = htmlspecialchars($_GET['id']); // Get event ID from the URL

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
            
            $event_id = htmlspecialchars($_GET['id']);

            $oldrow = $event->firstById($event_id);
            // show($oldrow);
            $this->createnotifitaion($oldrow,$_POST);
            $this->sendEmailtoBuyers();
            $this->updateDetail($event,$event_id);
            
        }
        $row = $event->firstById($event_id);
        $data1= $this->getData($row);

        // Fetch income and ticket count progress
        $income_data = $this->ticketIncome($ticket, $event_id);
        //show($income_data);
        //show($income_data);
        $ticket_count_data = $this->getAllTicketCount($ticket, $event_id);
        //show($ticket_count_data);

        // Combine all data to pass to the view
        $data2= array_merge($income_data, $ticket_count_data);
        $data = array_merge($data1, $data2);



        $eventtickets = $this->getticketdetails($event,$event_id);
        // show($eventtickets);
        $data['tickets'] = $eventtickets;

        $this->view('eventPlanner/scheduledEvent',$data);
    }

    public function getData($row) {
        $data = json_decode(json_encode($row), true);
        //show($data);
        return $data;
    }

    public function updateDetail($event, $event_id) {
        // Message for feedback (optional)
        $msg = "Event updated successfully";
    
        // Sanitize and validate POST data
        $updateData = [
            'event_date' => $_POST['event_date'] ?? null,
            'start_time' => $_POST['starttime'],
            'end_time' => $_POST['endtime'],
        ];
    
        // Filter out null values to avoid overwriting with empty fields
        $filteredData = array_filter($updateData, function ($value) {
            return $value !== null;
        });
    

        

        // Debugging: Show the data being sent to the update method
        // show($filteredData);
    

        // Check if there's data to update
        if (!empty($filteredData)) {
            $event->update($event_id, $filteredData);
        } else {
            $msg = "No valid data to update";
        }
    }
    

    public function createnotifitaion($old,$new){
        $notification = new Notification;
        $buyticket = new Buyticket;

        $changes=[];
        $buyers =[];
        if($new['event_date'] !== $old->eventDate){
            $changes[] = "Event Date changed from {$old->eventDate} to {$new['event_date']}";
            $link = "notification-event?id={$old->id}";
        }
        if (isset($new['starttime'])) {
            $new_start = date('H:i:s', strtotime($new['starttime']));
            $old_start = date('H:i:s', strtotime($old->start_time));
            if ($new_start !== $old_start) {
                $changes[] = "Start Time changed from {$old->start_time} to $new_start";
            }
            $link = "notification-event?id={$old->id}";
        }
        if (isset($new['endtime'])) {
            $new_end = date('H:i:s', strtotime($new['endtime']));
            $old_end = date('H:i:s', strtotime($old->end_time));
            if ($new_end !== $old_end) {
                $changes[] = "End Time changed from {$old->end_time} to $new_end";
            }
            $link = "notification-event?id={$old->id}";
        }
        $buyers = $buyticket->getticketbuyers($old->id);
        
        if (!empty($changes)) {
            $buyers = $buyticket->getticketbuyers($old->id);
            
            foreach ($buyers as $buyer) {
                $notifymsg = [
                    'user_id' => $buyer->user_id,
                    'title' => "Change in Event '{$old->event_name}' Details",
                    'message' => json_encode($changes),
                    'is_read' => 0,
                    'link' => $link,
                ];
                $notification->insert($notifymsg);
            }
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

    public function getticketdetails($event,$event_id){
        $all_data = $event->getAllEventData($event_id);
        
        return $all_data['tickets'];
    }

    public function sendEmailtoBuyers()
    {
        $mail = new PHPMailer\PHPMailer\PHPMailer(true);
        $buyticket = new Buyticket;
        $user = new User;

        try {
            // SMTP configuration
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'irumiabeywickrama@gmail.com';
            $mail->Password = 'diem tlif lxgm wgjx'; // Store this securely
            $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;

            // Set email details
            $mail->setFrom('irumiabeywickrama@gmail.com', 'Musicia');

            // Get event ID from GET parameter
            $event_id = htmlspecialchars($_GET['id']);
            
            // Get buyers for this event
            $buyers = $buyticket->getticketbuyers($event_id);
            
            if (!empty($buyers) && is_array($buyers)) {
                // Get user emails for each buyer
                foreach ($buyers as $buyer) {
                    if (isset($buyer->user_id)) {
                        $userData = $user->firstById($buyer->user_id);
                        if ($userData && !empty($userData->email)) {
                            $mail->addAddress($userData->email);
                        }
                    }
                }
            }

            $mail->isHTML(true);
            $mail->Subject = "Event Details Update";

            // Get the event details
            $event = new Event;
            $eventDetails = $event->firstById($event_id);

            // Generate the email body
            $emailBody = "<h1>Event Details Update</h1>";
            $emailBody .= "<p>There have been changes to the event you purchased tickets for:</p>";
            $emailBody .= "<h2>{$eventDetails->event_name}</h2>";
            
            // Get the changes from POST data
            $changes = [];
            if(isset($_POST['event_date']) && $_POST['event_date'] !== $eventDetails->eventDate) {
                $changes[] = "Event Date changed from {$eventDetails->eventDate} to {$_POST['event_date']}";
            }
            if(isset($_POST['starttime'])) {
                $new_start = date('H:i:s', strtotime($_POST['starttime']));
                $old_start = date('H:i:s', strtotime($eventDetails->start_time));
                if($new_start !== $old_start) {
                    $changes[] = "Start Time changed from {$eventDetails->start_time} to $new_start";
                }
            }
            if(isset($_POST['endtime'])) {
                $new_end = date('H:i:s', strtotime($_POST['endtime']));
                $old_end = date('H:i:s', strtotime($eventDetails->end_time));
                if($new_end !== $old_end) {
                    $changes[] = "End Time changed from {$eventDetails->end_time} to $new_end";
                }
            }

            // Add changes to email body
            if(!empty($changes)) {
                $emailBody .= "<ul>";
                foreach($changes as $change) {
                    $emailBody .= "<li>" . htmlspecialchars($change) . "</li>";
                }
                $emailBody .= "</ul>";
            }

            $emailBody .= "<p>Please check your account for updated ticket details.</p>";
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
