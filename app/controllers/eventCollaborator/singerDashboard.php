<?php 

class SingerDashboard {

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
        //show($profiledata);

        $upcomingEvents = $request->getUpcomingEvents($userId,3);
        //show($upcomingEvents);

        $commentsForUser = $commnets->getCommnet($userId);
        // show($commentsForUser);



        $this->view('eventCollaborator/singerdashboard',['userdata'=>$userdata,'profiledata'=>$profiledata, 'upcomingEvents'=>$upcomingEvents, 'commentsForUser'=>$commentsForUser]);

    }

    public function fetchUserDetails($userId,$user){
        $row = $user->firstById($userId);
        
        $data=json_decode(json_encode($row), true);
        return $data;

    }

   
}