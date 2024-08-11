<?php 
 class Home {

    use Controller;
     
    use Model;
    public function index(){
        echo "This is the home controllers";

        $this->view('home');

        $user = new User;

        $arr['name'] = 'vindyahewa';
        $arr['email'] = 'vindya@gmail.com';
        $arr['password'] = 'vindya';
        $arr['username'] = 'vindya123';

        $result = $user->update(20,$arr);
        show($result);
    }
 }

 