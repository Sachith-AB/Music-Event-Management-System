<?php 
 class Home {

    use Controller;
     
    use Model;
    public function index(){
        echo "This is the home controllers";

        $this->view('home');

        $user = new User;

        $arr['id'] = 19;

        $result = $user->first($arr);
        show($result);
    }
 }

 