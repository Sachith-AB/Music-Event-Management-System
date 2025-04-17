<?php 

class PinInput {
    use Controller;
    
    public function index(){
        $this->view('forgotPassword/pinInput', [], false);
    }
}