<?php

class UpdateProf {

    use Controller;
    use Model;

    public function index () {

        $user = new User;

        $data = $this->updateProfile($user);
        $this->view('ticketHolder/updateProfile',$data);
    }

    public function updateProfile($user) {

        $id = htmlspecialchars($_GET['id']);
        
        $row = $user->firstById($id);
        //show($row);
        $data = json_decode(json_encode($row),true);
        return $data;


    }
}