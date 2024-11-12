<?php

class Profile {

    use Controller;

    use Model;

    

    public function index(){

        $user = new User;

        $data = $this->profile($user);
        //show( $data);
        $this->view('ticketHolder/profile', $data);
        
    }

    public function profile($user){

        $id = htmlspecialchars($_GET['id']);
        //echo $id;

        $row = $user->firstById($id);
        $data = json_decode(json_encode($row),true);
        $_SESSION['USER'] = $row;
        //show($data) ;
        return $data;
        //show($row);
    }
}