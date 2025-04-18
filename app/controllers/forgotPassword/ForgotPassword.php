<?php 

class ForgotPassword {
    use Controller;
    
    public function index(){

        $password = new Password;
        $data = [];

        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['verify'])) {
            $email = $_POST['email'] ;
            $data = $this->verifyEmail($email,$password);
        }
        $this->view('forgotPassword/forgotpassword', $data, false);
    }

    private function verifyEmail($email,$password){

        if($password->validEmail($email)){
            $arr['email'] = $email;
            // To check email is taken or not
            $row = $password->first($arr);


            //Check email taken or not
            if($row == 0){
                $error = "Email is Not Exist";
                $errors = 'flag=' . 1 . '&error=' . $error . '&error_no=' . 7 ;
                redirect("forgot-password?$errors");
                exit;
            }else {
                //send email with 4 digit code
                //redirect to verify page with email and code
                redirect('pin-input');
            }
        }else{
            return $password->errors;
        }
    }
}