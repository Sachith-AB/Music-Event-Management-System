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

        if($user->signInData($_POST)){
            
            $arr['email'] = $_POST['email'];

            $row = $user->first($arr);
            
            // Proceed if $row exists and is_delete is '0'
            if ($row){

                if($row->is_delete == 1){
                    $error = "User is deleted";

                    $passData = 'email=' . $_POST['email'] . '&pass=' . $_POST['password'];
                    $errors = 'flag=' . 1 . '&error=' . $error . '&error_no=' . 6 ;

                    unset($_POST['signIn']);
                    redirect("signin?$errors&$passData");
                    exit;
                }
                //row->is_delete
                $checkpassword = password_verify($_POST['password'], $row->password);

                if($checkpassword){
                    
                    unset($row->password);
                    
                    session_start();
                    $_SESSION['USER'] = $row;
                    $id = $row->id;

                    //ADMIN CHECK TO REDIRECT
                    if($row->is_admin == 1)
                    {
                        redirect("admin-dashboard");
                    }

                    else 
                    {
                        redirect("home");
                    }

                    
                    // Set the session start time
                    $_SESSION['LAST_ACTIVITY'] = time(); // Store the current time

                }else{
                    $error = "Password Invalid";

                    $passData = 'email=' . $_POST['email'] . '&pass=' . $_POST['password'];
                    $errors = 'flag=' . 1 . '&error=' . $error . '&error_no=' . 7 ;

                    unset($_POST['signIn']);
                    redirect("signin?$errors&$passData");
                    exit;
                }
            }else{

                $error = "User not found";

                $passData = $passData = 'email=' . $_POST['email'] . '&pass=' . $_POST['password'];
                $errors = 'flag=' . 1 . '&error=' . $error . '&error_no=' . 8 ;

                unset($_POST['signIn']);
                    redirect("signin?$errors&$passData");
                    exit;

            }
        }else{
                return $user->errors;
        }
    }
}