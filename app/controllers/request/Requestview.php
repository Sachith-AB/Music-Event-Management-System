<?php 

class Requestview {

    use Controller;

   

    public function index()
    {
        $request = new Request;
        $data = [];

        $user_id = $this->getUserId();
        // echo $user_id;

        $data = $this->displaySingerRequests($request,$user_id);

        $this->view('request/request', $data);
        // show($data);
        

    }

    public function displaySingerRequests($request,$user_id)
    {
        $data = $request->getSingerRequests($user_id);

        return $data;
        
    }

    public function getUserId()
    {
        $id = $_SESSION['USER']->id;

        return $id;
    }

   
}


