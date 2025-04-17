<?php 

class ForgotPassword {
    use Controller;
    
    public function index(){
        // $user = new User;
        // $data = [];

        // if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //     $email = htmlspecialchars($_POST['email']);
        //     $data['email'] = $email;
            
        //     // Validate email
        //     if (empty($email)) {
        //         $data['error'] = "Email is required";
        //     } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        //         $data['error'] = "Invalid email format";
        //     } else {
        //         // Check if email exists in the database
        //         if ($user->findByEmail($email)) {
        //             // Send reset password link to the email
        //             // Assuming sendResetLink is a method that sends the email
        //             if ($user->sendResetLink($email)) {
        //                 $data['success'] = "Reset password link sent to your email";
        //             } else {
        //                 $data['error'] = "Failed to send reset password link";
        //             }
        //         } else {
        //             $data['error'] = "Email not found in our records";
        //         }
        //     }
        // }

        $this->view('forgotpassword', [], false);
    }
}