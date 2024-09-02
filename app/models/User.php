<?php 

class User {
    use Model;

    protected $table = 'users';
    protected $allowedColumns = [
        'name',
        'email',
        'password',
        'contact',
        'pro_pic'
    ];

    public function validUser($data) {
        
        $this->errors = [];

        //flage mean errors include

        // is empty name
        $this->errors = [];

        // is empty name 
		if (empty($data['name'])) {
			$this->errors['flag'] = true;
			$this->errors['error'] = "Name is Required ";
			$this->errors['error_no'] = 1;
			return;
		}

        // is empty email 
		if (empty($data['email'])) {
			$this->errors['flag'] = true;
			$this->errors['error'] = "Email is Required ";
			$this->errors['error_no'] = 2;
			return;
		}

        else if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
			$this->errors['flag'] = true;
			$this->errors['error'] = "Email is not Valid ";
			$this->errors['error_no'] = 3;
			return;
		}

        // is empty password 
		if (empty($data['password']) || empty($data['confirm-password'])) {
			$this->errors['flag'] = true;
			$this->errors['error'] = "Password is Required ";
			$this->errors['error_no'] = 5;
			return;
		} else if ($data['password'] != $data['confirm-password']) {
			$this->errors['flag'] = true;
			$this->errors['error'] = "Passwords does not match ";
			$this->errors['error_no'] = 6;
			return;
		}

        // errors no then hash passwords
		if (empty($this->errors)) {

			// password hashing 
			$password = $_POST['password'];
			$hash = password_hash($password, PASSWORD_BCRYPT);
			$_POST['password'] = $hash;
			//echo $_POST['password'];
			
            return true;
		} else {
			return false;
		}
        
    }

	public function signInData($data){

		$this->errors = [];

		// is empty email 
		if (empty($data['email'])) {
			$this->errors['flag'] = true;
			$this->errors['error'] = "Email is Required ";
			$this->errors['error_no'] = 1;
			return;
		}

		else if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
			$this->errors['flag'] = true;
			$this->errors['error'] = "Email is not Valid ";
			$this->errors['error_no'] = 2;
			return;
		}

		else if($data['email'])

		// is empty password 
		if (empty($data['password'])) {
			$this->errors['flag'] = true;
			$this->errors['error'] = "Password is Required ";
			$this->errors['error_no'] = 3;
			return;
		}	

		if (empty($this->errors)) {
			return true;
		} else {
			return false;
		}
	}
}