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

        if(empty($data['name'])){
            $this->errors['name'] = "Name is required";
        }

        if(empty($data['email'])){
            $this->errors['email'] = "Email is required";
        }else if(!filter_var($data['email'],FILTER_VALIDATE_EMAIL)){
            $this->errors['email'] = "Email is not valid";
        }

        if(empty($data['password'])){
            $this->errors['password'] = "Password is required";
        }

        if (isset($data['password']) && isset($data['confirm-password'])) {
            if ($data['password'] !== $data['confirm-password']) {
                $this->errors['confirm-password'] = "Passwords must match.";
            }
        }

        if(empty($data['agree'])){
            $this->errors['agree'] = "Please accept terms & conditions";
        }

        if(empty($this->errors)){
            return true;
        }

        return false;
    }
}