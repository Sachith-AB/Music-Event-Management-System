<?php

class BandRequest {

    use Controller;
    
    public function index(){

        $request = new Request;
        $data = [];

        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['request'])) {

            show($_POST);
            $this->createRequest($request);
            
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['deleteRequest'])){

            $this->deleteRequest($request);
        }

        if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['searchBands'])){
            
            
            $data['users'] = $this->searchUsers($request);
            // show($data);
            // show($_POST);
        }else{
            $data['users'] = $this->getUsers($request);
        }

        $data['request'] = $this->getExistingRequest($request);

        $this->view('request/bandsRequest',$data);
    }

    public function getUsers($request)
    {
        $data = $request->getUsersByRole('band','profile');
        return $data;

    }

    public function createRequest($request)
    {

    $res =  $request->insert($_POST);
    return $res;

    }

    public function searchUsers($request){
        
        $res = $request->searchByTerm($_POST , 'band' , 'profile');
        // show($res);
        unset($_POST['searchTerm']);
        unset($_POST['search']);
        return $res;
    }   

    public function getExistingRequest($request)
    {

        $id = htmlspecialchars($_GET['id']);

        $result = $request->getExistingRequests($id,'band');

        return $result;
    }

    public function deleteRequest($request)
    {
        $request->delete($_POST['req_id']);
        unset($_POST);
    }

}