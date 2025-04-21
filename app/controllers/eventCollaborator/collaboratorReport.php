<?php

class CollaboratorReport {

    use Controller;
    use Model;


    public function index()
    {
        $request = new Request;

        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['generate-report'])) {

            // show($_POST);
            $data = $this->getRequests($request);
            // show($data);
            $this->view('eventcollaborator/collaboratorreport',$data);

        }
        else 
        {
            $this->view('eventcollaborator/collaboratorreport',);
        }

       
    }


    public function getRequests($request)
    {
        $start_date = $_POST['start-date'];
        // show($start_date);
        $end_date = $_POST['end-date'];
        // show($end_date);
        
        $res = $request->getRequestsForCollaborators($start_date, $end_date );
        return $res;
    }


}