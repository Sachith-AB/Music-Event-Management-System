<?php 

class Signup {

    use Controller;
    public function index() {
        
        $user = new User;

        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['signUp'])) {
            $this->userRegistration($user,$_POST);
            
        }
        $this->view('signup');
    }


    //All users sign up
    private function userRegistration($user,$POST){
        
        //pass values to variables come from post method
        $name = $POST['name'];
        $email = $POST['email'];
        $password = $POST['password'];
        $confirm_password = $POST['confirm-password'];

        //check data validation
        if($user->validUser($_POST)){

            unset($POST['signUp']); //Remove sign up key before saving
            unset($POST['confirm-password']); //Remove confirm-password before saving

            $res = $user->insert($POST);
            redirect('signin');
        }
    }

    private function userLogin($user,$POST){}
}

