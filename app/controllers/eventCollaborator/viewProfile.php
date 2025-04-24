<?php 

class ViewProfile {

    use Controller;
    use Model;

    public function index()
    {
        $user = new User;
        $profile = new Profile;
        $request = new Request;
        $commnets = new Comment;
        $calendar = new Calendar;
        $data = [];
        $id = $_SESSION['USER']->id;


        $userId = htmlspecialchars($_GET['id']);
        // show($userId);

        $userdata = $this -> fetchUserDetails($userId,$user);
        // show($userdata);

        $profiledata = $profile -> getUserDetails($userId);
        // show($profiledata);

        $upcomingEvents = $request->getUpcomingEvents($userId,3);
        //show($upcomingEvents);


        $commentsForUser = $commnets->getCommnet($userId);

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_comment'])) {
            // show($_POST);
            $this->addComment($userId, $commnets, $_POST);
            redirect("collaborator-viewprofile?id=" . $userId);
            
        }
        
        // Get events for the profile being viewed
        $events = $this->getAcceptedEvent($userId, $request);
        
        // Format event times for regular events
        if(!empty($events)) {
            foreach($events as &$event) {
                // Format times to 12-hour format
                if(isset($event->start_time)) {
                    $time = strtotime($event->start_time);
                    $event->start_time = date('h:i A', $time);
                }
                if(isset($event->end_time)) {
                    $time = strtotime($event->end_time);
                    $event->end_time = date('h:i A', $time);
                }
            }
            unset($event); // Break the reference
        }
        
        // Get unavailable dates for the profile being viewed
        $unavailableDates = $calendar->getUserCalendar($userId);
       // show("Unavailable dates:");
       // show($unavailableDates);
        
        // Combine events and unavailable dates
        $calendarData = $events ?: [];
        
        if(!empty($unavailableDates)) {
            foreach($unavailableDates as $date) {
                if($date->is_available == 0) {
                    $calendarData[] = (object)[
                        'eventDate' => $date->date,
                        'event_name' => 'Unavailable',
                        'description' => 'I am not available on this date',
                        'status' => 'unavailable',
                        'start_time' => 'All Day',
                        'end_time' => 'All Day'
                    ];
                }
            }
        }

        $this->view('eventCollaborator/viewprofile', [
            'userdata' => $userdata,
            'profiledata' => $profiledata, 
            'upcomingEvents' => $upcomingEvents, 
            'commentsForUser' => $commentsForUser,
            'data' => $calendarData // Pass calendar data to the view
        ]);
    }

    public function fetchUserDetails($userId,$user){
        $row = $user->firstById($userId);
        
        $data=json_decode(json_encode($row), true);
        return $data;

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

    private function getAcceptedEvent($id, $request){
        $res = $request->getAcceptedEvents($id);
        if($res) {
            foreach($res as &$event) {
                // Format times to 12-hour format
                if(isset($event->start_time)) {
                    $time = strtotime($event->start_time);
                    $event->start_time = date('h:i A', $time);
                }
                if(isset($event->end_time)) {
                    $time = strtotime($event->end_time);
                    $event->end_time = date('h:i A', $time);
                }
            }
            unset($event); // Break the reference
        }
        return $res ?: [];
    }

   
}