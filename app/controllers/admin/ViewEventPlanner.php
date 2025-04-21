<?php 

class ViewEventPlanner {

    use Controller;
    use Model;

    public function index() {
        $commnets = new Comment();
        $userId = $_SESSION['USER']->id;

        $userId=htmlspecialchars($_GET['id']);

        // if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['user_id']))
        // {
        //     $userId = $_POST['user_id'];
        // }

        $buyTicketModel = new Buyticket();
        $eventBuyers = $buyTicketModel->getEventBuyers($userId);

        // Fetch events created by this user
        $eventModel = new Event(); // Assuming Event model exists
        $userEvents = $eventModel->getEventsByUserId($userId);
        
        usort($userEvents, function($a, $b) {
            return strtotime($b->start_time) - strtotime($a->start_time);
        });

        $totalRevenue = 0;
        $totalTicketsSold = 0;
        $totalTicket=0;
        $totalEvents = count($userEvents) ?? 0; // Number of events
        $totalEventBuyers = count($eventBuyers) ?? 0;

        // Calculate total revenue and total tickets sold
        foreach ($userEvents as $event) {
            $totalRevenue += $event->total_revenue;
            $totalTicketsSold += $event->sold_quantity;
            $totalTicket += $event->total_quantity;
        }

        $commentsForUser = $commnets->getCommnet($userId);

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_comment'])) {
            // show($_POST);
            $this->addComment($userId, $commnets, $_POST);
            redirect("admin-vieweventplanner?id=" . $userId);
            
        }
        

        // Pass the events data to the view
        $this->view('admin/vieweventplanner', ['events' => $userEvents,'eventBuyers' => $eventBuyers,'totalRevenue' => $totalRevenue,
            'totalTicketsSold' => $totalTicketsSold,'totalEvents' => $totalEvents,'totalEventBuyers' => $totalEventBuyers, 'totalTicket'=> $totalTicket,'commentsForUser'=>$commentsForUser]);
    }

    public function addComment($userId, $commnets, $comment) {
        // Prepare data for insertion
        $data = [
            'receiver_id' => htmlspecialchars($comment['receiver_id']),
            'sender_id' => htmlspecialchars($comment['sender_id']),
            'content' => htmlspecialchars($comment['content']),
            'created_at' => date('Y-m-d H:i:s')
        ];
        // Save comment
        $commnets->insert($data);
    }
   
}