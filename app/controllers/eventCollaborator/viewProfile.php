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
        $data = [];


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
        


        $this->view('eventCollaborator/viewprofile',['userdata'=>$userdata,'profiledata'=>$profiledata, 'upcomingEvents'=>$upcomingEvents, 'commentsForUser'=>$commentsForUser]);

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

   
}