<?php 


class Signup {

    use Controller;
    public function index() {
        
        $user = new User;
        $data = [];

        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['signUp'])) {
            $data = $this->userRegistration($user,$_POST);
            //show($_POST);
            
        }
        
        $this->view('signup',$data,false);
    }


    private function userRegistration($user,$POST){
        
        //pass values to variables come from post method
        $name = $POST['name'];
        $email = $POST['email'];
        $password = $POST['password'];
        $confirm_password = $POST['confirm-password'];
        
        //check data validation
        if($user->validUser($_POST)){

            
            $arr['email'] = $_POST['email'];
            // To check email is taken or not
            $row = $user->first($arr);
            //show($row);

            //Check email taken or not
            if($row == 0){

                unset($POST['signUp']); //Remove sign up key before saving
                unset($POST['confirm-password']); //Remove confirm-password before saving
                $user->insert($_POST);
                redirect('signin');
            }else {
                $error = "Email is Already Taken";
                $passData = 'email=' . $_POST['email'] . '&pass=' . $_POST['password'];
                $errors = 'flag=' . 1 . '&error=' . $error . '&error_no=' . 7 ;

                unset($_POST['signUp']);
                redirect("home?$errors&$passData");
                exit;
            }
        }else{

            //show($user->errors);
            return $user->errors;
        }
    }
}

