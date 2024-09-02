<?php 
 class Home {

    use Controller;
     
    use Model;
    public function index(){

        $user = new User;
        
        $data = $this->getData($user);
        $this->view('home',$data);


    }

    public function getData($user) {

        $id = htmlspecialchars($_GET['id']);
        
        $row = $user->firstById($id);
        //show($row);
        $data = json_decode(json_encode($row),true);
        return $data;


    }
 }

 