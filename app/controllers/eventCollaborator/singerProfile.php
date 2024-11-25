<?php 

class SingerProfile {

    use Controller;
    use Model;

    public function index()
    {
        $user = new User;
        $profile = new Profile;

        $userId = htmlspecialchars($_GET['id']);

        $data = $this->profile($user);
        // show( $data);


        $profiledata = $profile -> getUserDetails($userId);
        // show($profiledata);

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
            // show($_POST);
            $this->profileDetails($profile,$userId, $_POST);
        }
        $this->view('eventCollaborator/singerProfile',['data'=>$data,'profiledata'=>$profiledata]);

    }

    public function profile($user){

        $id = $_SESSION['USER']->id ?? 0;
        //echo $id;

        $row = $user->firstById($id);
        $data = json_decode(json_encode($row),true);
        $_SESSION['USER'] = $row;
        //show($data) ;


        return $data;
        //show($row);
    }

    public function profileDetails($profile, $userId, $POST) {
        unset($POST['submit']); // Remove submit key from POST array
        if ($profile->checkIfUserExists($userId)) {
            // Update the existing profile
            $profile->update($_POST['id'], $POST);
        } else {
            // Insert a new profile
            $POST['userID'] = $userId; // Ensure userID is included in the data
            $profile->insert($POST);
        }
        redirect("colloborator-dashboard?id=" . $userId);
    }
    
   
}