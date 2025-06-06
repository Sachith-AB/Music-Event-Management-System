<?php

class CollaboratorReport {

    use Controller;
    use Model;


    public function index()
    {
        $request = new Request;

        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['generate-report'])) {


            $start_date = $_POST['start-date'];
            $end_date = $_POST['end-date'];
            $today = date('Y-m-d');

            // "From date must be earlier than "To" date 
            if($start_date > $end_date) {

                $error = "The Start date must be earlier than or same as the End date. ";
                $errorParams = 'flag=1&error=' . urlencode($error) . '&error_no=1';
            
                redirect('collaborator-report?'. $errorParams);

            }

            // no future dates
            elseif($start_date > $today || $end_date > $today)
            {
                $error = "Dates cannot be in the future";
                $errorParams = 'flag=1&error=' . urlencode($error) . '&error_no=1';
            
                redirect('collaborator-report?'. $errorParams);
            }

            else 
            {
                // show($_POST);
                $data = $this->getRequests($request);
                // show($data);
                $this->view('eventcollaborator/collaboratorreport',$data);

            }
    

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