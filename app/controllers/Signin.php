<?php 

class Signin {

    use Controller;

    public function index() {

        $user = new User;
        $data = [];
        
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['signIn'])){

            $data = $this->userLogin($user);
            //show($data);
        }
        $this->view('signin',$data,false);
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
                    
                    unset($row->password);
                    
                    session_start();
                    $_SESSION['USER'] = $row;
                    $id = $row->id;

                    redirect("home");

                    // Set the session start time
                    $_SESSION['LAST_ACTIVITY'] = time(); // Store the current time

                }else{
                    //echo "error";
                    $error = "Password Invalid";

                    $passData = 'email=' . $_POST['email'] . '&pass=' . $_POST['password'];
                    $errors = 'flag=' . 1 . '&error=' . $error . '&error_no=' . 7 ;

                    unset($_POST['signIn']);
                    redirect("signin?$errors&$passData");
                    //echo 'check';
                    exit;
                    //return $error; 
                }
            }else{

                $error = "User not found";

                $passData = $passData = 'email=' . $_POST['email'] . '&pass=' . $_POST['password'];
                $errors = 'flag=' . 1 . '&error=' . $error . '&error_no=' . 8 ;

                unset($_POST['signIn']);
                    redirect("signin?$errors&$passData");
                    //echo 'check';
                    exit;
                    //return $error;

            }
        }else{
                //show($user->errors);
                return $user->errors;
        }
    }
}