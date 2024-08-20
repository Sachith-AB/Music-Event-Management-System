<?php 

class Signin {

    use Controller;

    public function index() {

        $user = new User;
        $data = [];
        
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['signIn'])){

            $data = $this->userLogin($user);
            show($data);
        }
        $this->view('signin',$data);
    }

    private function  userLogin($user){
        //echo 'check';

        if($user->signInData($_POST)){
            
            //echo 'check';
            $arr['email'] = $_POST['email'];

            $row = $user->first($arr);
            //show($row);
            if($row){

                //echo 'check';
                $checkpassword = password_verify($_POST['password'], $row->password);

                if($checkpassword){
                    echo 'check';
                    unset($row->password);
                    session_start();
                    $_SESSION['USER'] = $row;
                    redirect('home');

                }else{
                    echo "error";
                    $error = "Invalid Email or Password";
                }
            }
        }else{
                //show($user->errors);
                return $user->errors;
        }
    }
}