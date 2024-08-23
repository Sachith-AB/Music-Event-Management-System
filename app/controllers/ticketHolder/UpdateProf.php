<?php

class UpdateProf {

    use Controller;
    use Model;

    public function index () {

        $user = new User;
        $data = [];
        $success = '';

        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])){
            
            $this->updateDetail($user,$_POST);
            //show($_POST);
        }
        $data = $this->getData($user);
        $this->view('ticketHolder/updateProfile',$data);
    }

    public function getData($user) {

        $id = htmlspecialchars($_GET['id']);
        
        $row = $user->firstById($id);
        //show($row);
        $data = json_decode(json_encode($row),true);
        return $data;


    }

    public function updateDetail($user,$POST) {

        $id = htmlspecialchars($_GET['id']);
        $msg = "Profile updated Succesfully";
        $success = 'flag=' . 2 . '&msg=' . $msg . '&success_no=' . 1;
        $res = $user->update($id,$POST);
        unset($POST['update']);
        redirect("profile?id=$id&$success");
    }
}