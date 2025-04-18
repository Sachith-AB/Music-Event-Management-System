<?php 

class PinInput {
    use Controller;
    
    public function index(){

        $hashedCode = htmlspecialchars($_GET['code'] ?? '');
        $email = htmlspecialchars($_GET['email'] ?? '');
        
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['verifyCode'])) {
            $code = $_POST['c1'] . $_POST['c2'] . $_POST['c3'] . $_POST['c4'];
            $codeEntered = $code;
            $this->validatePin($hashedCode,$codeEntered,$email);
            
        }

        $this->view('forgotPassword/pinInput', [], false);
    }

    private function validatePin($hashedCode, $codeEntered,$email) { 
        if(password_verify($codeEntered, $hashedCode)){
            // PIN is correct, proceed with password reset
            $msg = 'flag=2&msg=PIN Verified&success_no=1&email=' . urlencode($email);
            redirect("reset-password?$msg");
        } else {
            // PIN is incorrect, show error message
            $error = "Invalid PIN. Please try again.";
            $errors = 'flag=1&error=' . urlencode($error) . '&error_no=9' . '&code=' . urlencode($hashedCode) . '&email=' . urlencode($email);
            redirect("pin-input?$errors");
            exit;
        }
    }
    
}