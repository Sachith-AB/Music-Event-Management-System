<?php

class SoundRequest {

    use Controller;
    
    public function index(){

        $request = new Request;
        $data = [];

        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['request'])) {

            $this->createRequest($request);
            
        }

        if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['searchBands'])){
            
            
            $data = $this->searchUsers($request);
            // show($data);
            // show($_POST);
        }else{
            $data = $this->getUsers($request);
        }

        $this->view('request/soundRequest',$data);
    }

    public function getUsers($request)
    {
        $data = $request->getUsersByRole('sound','profile');
        return $data;

    }

    public function createRequest($request)
    {

    $res =  $request->insert($_POST);
    return $res;

    }

    public function searchUsers($request){
        
        $res = $request->searchByTerm($_POST , 'sound' , 'profile');
        // show($res);
        unset($_POST['searchTerm']);
        unset($_POST['search']);
        return $res;
    }   

}