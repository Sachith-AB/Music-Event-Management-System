<?php 

class Requestdropdown {

    use Controller;
    public function index() {

        $request = new Request;
        $data = [];

        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['request'])) {

            $data = $this->createRequest($request,$_POST);
            
        }

        $data = $this->getSingers($request);
        $this->view('request/singerdropdown', $data);

       
        // show($data);

    }


    public function getSingers($request)
    {
        $data = $request->getSingerDetails();

        return $data;

    }

    public function createRequest($request,$POST)
     {

       $res =  $request->insert($_POST);
        return $res;

    }




}