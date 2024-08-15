<?php 

class Signup {
    
    use Controller;
    use Model;

    public function index() {

        $data = [];

        

        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            $user = new User;
            if($user->validUser($_POST)){
                $user->insert($_POST);
                redirect('signin');
            }else {
                $data['errors'] = $user->errors;
            }
    
        }
        
        
        $this->view('signup',$data);
    }
}