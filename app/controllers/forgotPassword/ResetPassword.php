<?php 

class ResetPassword {
    use Controller;
    
    public function index(){
        $this->view('forgotPassword/resetPassword', [], false);
    }
}