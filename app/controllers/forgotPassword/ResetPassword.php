<?php 

class ResetPassword {
    use Controller;
    
    public function index(){

        $user = new User;
        $email = htmlspecialchars($_GET['email'] ?? '');
        $data=[];

        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['change-password'])){
            $data = $this->changePassword($user,$email);
        }

        $this->view('forgotPassword/resetPassword', $data, false);
    }

    private function changePassword($user,$email){

        $arr['email'] = $email;
        $row = $user->first($arr);
        //show($row);
        $id = $row->id;

        if($user->forgotPasswordChange($_POST)){
            unset($_POST['change-password']);
            unset($_POST['c-password']);

            $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $_POST['password'] = $hash;

            $user->update($id,$_POST);
            unset($_POST['password']);
            redirect('signin');
        }else{
            unset($_POST);
            return $user->errors;
        }
    }
}