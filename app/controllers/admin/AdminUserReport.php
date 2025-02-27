<?php

class AdminUserReport{
    use Controller;

    public function index()
    {
        $user = new User;
        $data = [];
        
        $data['totalUsers'] = $this->displayTotalUsers($user);
        //show($data['totalUsers']);
        $data['totalUsersByMonth'] = $this->displayTotalUsersByMonth($user);
        //show($data['totalUsersByMonth']);
        
        $this->view('admin/userReport', $data);
    }

    public function displayTotalUsers($user)
    {
        $result = $user->getTotalUsers();
        //show($result);
        return $result;
    }
	
    public function displayTotalUsersByMonth($user)
    {
        $result = $user->getTotalUsersByMonth();
        //show($result);
        return $result;
    }
	
}