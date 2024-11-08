<?php 

class Requestdropdown {

    use Controller;
    public function index() {

        $request = new Request;
        $data = [];

        $data = $this->getSingers($request);
        $this->view('request/singerdropdown', $data);
       

        // show($data);

    }


    public function getSingers($request)
    {
        $data = $request->getSingerDetails();

        return $data;

    }


}