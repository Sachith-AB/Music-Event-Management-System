<?php 

class Requestview {

    use Controller;

   

    public function index()
    {
        $request = new Request;
        $data = [];

        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['accept'])) {

            // show($_POST);
            $this->updateRequests($request);
            
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['reject'])) {

            $this->updateRequests($request);
            
        }
        
        $user_id = $this->getUserId();
        // echo $user_id;

        $data['requests'] = $this->displaySingerRequests($request,$user_id);

        $data['accepted'] = $this->displayAcceptedRequests($request,$user_id);
        // show($data['accepted']);                                                                                                                                                                                                                                         

        $this->view('request/request', $data);
        
        // show($data);
        

    }

    public function displaySingerRequests($request,$user_id)
    {
        $data = $request->getSingerRequests($user_id);

        return $data;
        
    }

    public function displayAcceptedRequests($request,$user_id)
    {
        $data = $request->getAcceptedRequests($user_id);

        return $data;
    }

    public function getUserId()
    {
        $id = $_SESSION['USER']->id;

        return $id;
    }

    public function updateRequests($request)
    {
        $id = $_POST['req_id'];

        $request->update($id,$_POST);
    }

   
}


