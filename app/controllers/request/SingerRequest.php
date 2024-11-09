<?php 

class SingerRequest {

    use Controller;
    public function index() {


        $request = new Request;
        $data = [];

        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['request'])) {

            $this->createRequest($request);
            
        }

        if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['search'])){
            
            
            $data = $this->searchSingers($request);
            // show($data);
            // show($_POST);
        }else{
            $data = $this->getSingers($request);
        }

        
        $this->view('request/singerRequest', $data);

        // show($data);

    }


    public function getSingers($request)
    {
        $data = $request->getSingerDetails();

        return $data;

    }

    public function createRequest($request)
    {

    $res =  $request->insert($_POST);
    return $res;

    }

    public function searchSingers($request){
        
        $res = $request->searchSingers($_POST);
        // show($res);
        unset($_POST['searchTerm']);
        unset($_POST['search']);
        return $res;
    }   




}