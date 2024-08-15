<?php 

class Signin {

    use Controller;

    public function index() {

        $data = [];

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $user = new User;
            $arr['email'] = $_POST['email'];

            $row = $user->first($arr);
            //show($row);

            if($row){
                if($row->password === $_POST['password']){
                    $_SESSION['USER'] = $row;
                    //redirect('home');
                }
            }

            $user->errors['email'] = "Wrong email or password";
            $data['errors'] = $user->errors;

        }
        $this->view('signin');
    }
}