<?php 
 class Home {

    use Controller;
     
    use Model;
    public function index(){
        echo "This is the home controllers";

        $this->view('home');

        $user = new User;

        $arr['name'] = 'vindaya';
        $arr['email'] = 'vindya@gmail.com';
        $arr['password'] = 'sachith';
        $arr['username'] = 'vindya123';

        $result = $user->insert($arr);
        show($result);
    }
 }

 