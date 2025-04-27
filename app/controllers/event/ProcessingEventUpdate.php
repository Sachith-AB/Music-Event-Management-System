<?php 
class ProcessingEventUpdate{

    use Controller;
    use Model;

    public function index(){

        $event = new Event;
        $data = [];
        $success ='';

        $event_id = htmlspecialchars($_GET['event_id']);
        $row = $event->firstById($event_id);
        //show ($row);

        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])){
            $event_id = htmlspecialchars($_GET['event_id']);
            //show($event_id);
            show($_POST);
            $data['error']=$this->updateDetail($event,$event_id);
        }

        $data['event'] = $this->getData($row);
        $this->view('event/processingEventUpdate',$data);

    }


    public function getData($row){
        $data = json_decode(json_encode($row),true);
        return $data;
    }

    public function updateDetail($event,$event_id){
        
        $msg = "Event updated Successfully";
        $success = 'flag=' . 2 . '&msg=' . $msg . '&success_no=' . 1;

        if($event->validProcessingEventUpdate($_POST)){

            $event->update($event_id, $_POST);
            unset($_POST['update']);
            //show($_POST);
            redirect('event-planner-viewEvent?id='.$event_id);
        }else{
            return ['success' => false, 'errors' => $event->errors];
        }
        
    }
}