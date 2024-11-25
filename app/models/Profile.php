<?php 

class Profile {
    use Model;

    protected $table = 'profile';
    protected $allowedColumns = [
        'userID',
        'user_role',
        'music_genres',
        'biography',
        'skills',
		'equipment',
        'fb',
        'insta',
        'youtube',
        'twitter',
        'cover_pic'
    ];

    public function validUser($data) {
        
        $this->errors = [];

        //flage mean errors include

        // is empty name
        $this->errors = [];

        // is empty name 
		if (empty($data['user_role'])) {
			$this->errors['flag'] = true;
			$this->errors['error'] = "User role is Required ";
			$this->errors['error_no'] = 1;
			return;
		}

        // is empty email 
		if (empty($data['biography'])) {
			$this->errors['flag'] = true;
			$this->errors['error'] = "Biography is Required ";
			$this->errors['error_no'] = 2;
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


    public function getUserDetails($userId)
    {
        // Fetch profile details
        $profileQuery = "SELECT * FROM profile WHERE userID = :userID";
        $profileParams = ['userID' => $userId];
        $profile = $this->query($profileQuery, $profileParams);
        $profdata = json_decode(json_encode($profile),true);

        // Fetch past works
        $pastWorkQuery = "SELECT * FROM pastworks WHERE user_id = :userID";
        $pastWorkParams = ['userID' => $userId];
        $pastWorks = $this->query($pastWorkQuery, $pastWorkParams);
        $pastdata = json_decode(json_encode($pastWorks),true);

        // Fetch services
        $servicesQuery = "SELECT * FROM services WHERE user_id = :userID";
        $servicesParams = ['userID' => $userId];
        $services = $this->query($servicesQuery, $servicesParams);
        $servicedata = json_decode(json_encode($services),true);

        // Combine all data into a single array
        $data = [
            'profile' => $profdata[0] ?? null, // Assuming one profile per user
            'past_works' => $pastdata,
            'services' => $servicedata,
        ];

        return $data;
    }


    public function checkIfUserExists($userId) {
        $query = "SELECT * FROM profile WHERE userID = :userId LIMIT 1";
        $result = $this->query($query, ['userId' => $userId]);
        return !empty($result);
    }
}