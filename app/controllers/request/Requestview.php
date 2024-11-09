<?php 

class Requestview {

    use Controller;

    public function index()
    {
        $request = new Request;
        $data = [];

        $data = $this->displaySingerRequests($request);

        $this->view('request/request', $data);
        

    }

    public function displaySingerRequests($request)
    {
        $data = $request->getSingerRequests();

        return $data;
        
    }

   
}


