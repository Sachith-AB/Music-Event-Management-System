<?php 

class Password {
    use Model;

    protected $table = 'users';

    protected $allowedColumns = [
        'password',
    ];

    public function validEmail ($email) {
        $this->errors = [];

        //flag mean errors include

        // is empty email 
        if (empty($email)) {
            $this->errors['flag'] = true;
            $this->errors['error'] = "Email is Required ";
            $this->errors['error_no'] = 1;
            return;
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->errors['flag'] = true;
            $this->errors['error'] = "Email is not Valid ";
            $this->errors['error_no'] = 2;
            return;
        } 

        if (empty($this->errors)) {
			return true;
		} else {
			return false;
		}
    }
}