<?php 

class User {
    use Model;

    protected $table = 'users';
    protected $allowedColumns = [
        'name',
        'email',
        'password',
        'contact',
        'pro_pic',
		'role',
		'is_delete',
		'is_admin',
		'registered_at'
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

		// is empty password 
		if (empty($data['password'])) {
			$this->errors['flag'] = true;
			$this->errors['error'] = "Password is Required ";
			$this->errors['error_no'] = 3;
			return;
		}	
		show($this->errors);
		if (empty($this->errors)) {
			return true;
		} else {
			return false;
		}
	}

	public function changePassword($data){
		$this->errors = [];

		if(empty($data['password'])){
			$this->errors['flag'] = true;
			$this->errors['error'] = "Password is Required ";
			$this->errors['error_no'] = 1;
			return;
		}
		if(empty($data['n-password'])){
			$this->errors['flag'] = true;
			$this->errors['error'] = "New Password is Required ";
			$this->errors['error_no'] = 2;
			return;
		}
		if(empty($data['c-password'])){
			$this->errors['flag'] = true;
			$this->errors['error'] = "Confirm Password is Required ";
			$this->errors['error_no'] = 3;
			return;
		}else if ($data['n-password'] != $data['c-password']) {
			$this->errors['flag'] = true;
			$this->errors['error'] = "Passwords does not match ";
			$this->errors['error_no'] = 4;
			return;
		}

		if(empty($this->errors)){
			return true;
		}else{
			return false;
		}

	}


	public function getTotalUsers(){
		$query = "SELECT role, 
				COUNT(*) AS user_count FROM users
				GROUP BY role
				ORDER BY user_count DESC";

		$result = $this->query($query);
		//show($result);
		return $result;
	}

	public function getTotalUsersByMonth(){
		$query = "SELECT role,YEAR(registered_at) AS reg_year, MONTHNAME(registered_at) AS reg_month,
			COUNT(*) AS registration_count
			FROM users
			GROUP BY role, YEAR(registered_at), MONTH(registered_at)
			ORDER BY registration_count DESC
			LIMIT 5;";

		$result = $this->query($query);
		return $result;
	}
}