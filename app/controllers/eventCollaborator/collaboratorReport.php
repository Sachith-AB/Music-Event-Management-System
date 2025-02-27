<?php

class CollaboratorReport {

    use Controller;
    use Model;

    

    public function index()
    {
        $request = new Request;

        $data = $this->getRequests($request);
        // show($data);

        $this->view('eventcollaborator/collaboratorreport',$data);
    }


    public function getRequests($request)
    {
        $res = $request->getRequestsForCollaborators();
        return $res;
    }


}