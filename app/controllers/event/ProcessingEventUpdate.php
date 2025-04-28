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
            // Handle image upload if files are present
            if(isset($_FILES['coverImage']) && !empty($_FILES['coverImage']['name'][0])) {
                $imageNames = [];
                
                // Process each uploaded file
                foreach($_FILES['coverImage']['name'] as $index => $imageName) {
                    if(empty($imageName)) continue;
                    
                    $tmpName = $_FILES['coverImage']['tmp_name'][$index];
                    $error = $_FILES['coverImage']['error'][$index];
                    $size = $_FILES['coverImage']['size'][$index];
                    
                    $max_size = 5 * 1024 * 1024; // 5MB
                    
                    if($error === 0 && $size < $max_size) {
                        $img_ex = pathinfo($imageName, PATHINFO_EXTENSION);
                        $img_ex_lc = strtolower($img_ex);
                        
                        $allowed_exs = ["jpg", "jpeg", "png"];
                        
                        if(in_array($img_ex_lc, $allowed_exs)) {
                            $new_img_name = "event-pic=" . $event_id . "_" . uniqid() . "." . $img_ex_lc;
                            $upload_dir = dirname(dirname(dirname(dirname(__FILE__)))) . '/public/assets/images/events/';
                            
                            if(!is_dir($upload_dir)) {
                                mkdir($upload_dir, 0777, true);
                            }
                            
                            $img_upload_path = $upload_dir . $new_img_name;
                            
                            if(move_uploaded_file($tmpName, $img_upload_path)) {
                                $imageNames[] = $new_img_name;
                            }
                        }
                    }
                }
                
                // If new images were uploaded, update the cover_images field
                if(!empty($imageNames)) {
                    $_POST['cover_images'] = json_encode($imageNames);
                }
            }
            
            $event->update($event_id, $_POST);
            unset($_POST['update']);
            redirect('event-planner-viewEvent?id='.$event_id);
        } else {
            return ['success' => false, 'errors' => $event->errors];
        }
    }
}