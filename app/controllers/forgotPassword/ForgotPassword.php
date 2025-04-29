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

                // Generate random 4-digit PIN
                $code = rand(1000, 9999);

                // Store PIN & email in session
                $_SESSION['verification_email'] = $email;
                $_SESSION['verification_code'] = $code;

                //hash the code 
                $hashedCode = password_hash($code, PASSWORD_DEFAULT);

                // Call the email sender
                $result = $this->sendVerificationCodeEmail($email, $code);

                if ($result === true) {
                    // Redirect to pin input page
                    redirect('pin-input?email=' . urlencode($email) . '&code=' . $hashedCode);
                    $password->errors=null;
                    exit;
                } else {
                    // Email sending failed
                    $error = $result;
                    $errors = 'flag=1&error=' . urlencode($error) . '&error_no=8';
                    redirect("forgot-password?$errors");
                    exit;
                }
            }
        }else{
            return $password->errors;
        }
    }

    public function sendVerificationCodeEmail($recipientEmail, $code)
{
    $mail = new PHPMailer\PHPMailer\PHPMailer(true);

    try {
        // SMTP configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'musicia029cs@gmail.com';
        $mail->Password = 'ozyo ewaj pcff mamo'; // Store securely
        $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        // Email headers
        $mail->setFrom('irumiabeywickrama@gmail.com', 'Musicia');
        $mail->addAddress($recipientEmail);

        $mail->isHTML(true);
        $mail->Subject = "Your Password Reset Verification Code";

        // Email body
        $mail->Body = "
            <h1>Password Reset Verification</h1>
            <p>Dear user,</p>
            <p>Your verification code is:</p>
            <h2>$code</h2>
            <p>Enter this code in the website to continue resetting your password.</p>
            <p>If you didn't request this, please ignore this email.</p>
        ";

        // Send email
        $mail->send();
        return true;

    } catch (Exception $e) {
        return "Failed to send email: {$mail->ErrorInfo}";
    }
}

}