<?php 

class DecoratorsRequest {

    use Controller;
    public function index() {


        $request = new Request;
        $data = [];

        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['request'])) {

            $this->createRequest($request);
            
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['deleteRequest'])){

            $this->deleteRequest($request);
        }

        if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['searchDecorators'])){
            
            
            $data['users'] = $this->searchUsers($request);
            // show($data);
            // show($_POST);
        }else{
            $data['users'] = $this->getUsers($request);
        }


        $data['requests'] = $this->getExistingRequest($request);

        
        $this->view('request/decoratorsRequest', $data);

        // show($data);

    }


    public function getUsers($request)
    {
        $data = $request->getUsersByRole('decorator','profile');
        return $data;

    }

    public function createRequest($request)
    {

    $res =  $request->insert($_POST);
    return $res;

    }

    public function searchUsers($request){
        
        $res = $request->searchByTerm($_POST , 'decorator' , 'profile');
        // show($res);
        unset($_POST['searchTerm']);
        unset($_POST['search']);
        return $res;
    }   

    public function getExistingRequest($request)
    {
        $id = htmlspecialchars($_GET['id']);

        $result = $request->getExistingRequests($id,'decorator');

        return $result;
    }

    public function deleteRequest($request){

        //show($_POST['req_id']);
        $request->delete($_POST['req_id']);
        unset($_POST);
    }



}