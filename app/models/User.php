<?php 

class User {
    use Model;

    protected $table = 'users';
    protected $allowedColumns = [
        'name',
        'email',
        'password',
        'username',
        'pro_pic'
    ];

    public function validUser($data) {
        
        $this->errors = [];

        //flage mean errors include

        // is empty name
        $this->errors = [];

        if(empty($data['name'])){
            $this->errors['error'] = "Name is required";
            //return;
        }

        if(empty($data['email'])){
            $this->errors['error'] = "Email is required";
        }else if(!filter_var($data['email'],FILTER_VALIDATE_EMAIL)){
            $this->errors['error'] = "Email is not valid";
        }

        if(empty($data['password'])){
            $this->errors['error'] = "Password is required";
        }

        if (isset($data['password']) && isset($data['confirm-password'])) {
            if ($data['password'] !== $data['confirm-password']) {
                $this->errors['error'] = "Passwords must match.";
            }
        }
show($this->errors);
        if(empty($this->errors)){
			return true;
        }else{
            return false;
        }
           
        

        
    }
}