<?php

class Update {

    use Controller;
    use Model;

    public function index () {

        $event = new Event;
        $data = [];
        $success = '';

        $event_name = htmlspecialchars($_GET['event_name']);
        $row = $event->firstByEventName($event_name);
        //show($row);

        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])){
            
            $this->updateDetail($event);
            show($_POST);
        }

        
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['upload'])){
            $this->uploadImages($event,$_FILES);
            show($_FILES);
        }

        $data = $this->getData($row);
        $this->view('event/updateEvent',$data);
    }

    public function getData($row) {

        $data = json_decode(json_encode($row),true);
        return $data;
    }

    public function updateDetail($event) {

        $event_name = $_POST['event_name'];
        //Pass message
        $msg = "Event updated Succesfully";
        $success = 'flag=' . 2 . '&msg=' . $msg . '&success_no=' . 1;

        //Update event
        $event->update($_POST['event_id'], $_POST);
        unset($POST['update']);

        
        redirect("event-review?event_name=$event_name");
    }


    public function uploadImages($event, $FILES) {
        $id = $_POST['event_id'];
        show($_POST);
        $event_name = htmlspecialchars($_GET['event_name']);

        // Pass message
        $msg = "Profile updated successfully";
        $success = 'flag=2&msg=' . $msg . '&success_no=1';
        $imageNames = [];
    
        // Check if any files were uploaded
        if (isset($FILES['cover_images']['name']) && !empty($FILES['cover_images']['name'][0])) {
    
            // Loop through each uploaded file
            foreach ($FILES['cover_images']['name'] as $index => $imageName) {
                
                $tmpName = $FILES['cover_images']['tmp_name'][$index];
                $error = $FILES['cover_images']['error'][$index];
                $size = $FILES['cover_images']['size'][$index];
    
                $max_size = 2 * 1024 * 1024; // 2MB in bytes
    
                if ($error === 0 && $size < $max_size) {
    
                    // Get image extension
                    $img_ex = pathinfo($imageName, PATHINFO_EXTENSION);
                    $img_ex_lc = strtolower($img_ex);
    
                    // Allowed image extensions
                    $allowed_exs = array("jpg", "jpeg", "png");
    
                    if (in_array($img_ex_lc, $allowed_exs)) {
                        
                        // Create a unique name for the image
                        $new_img_name = "event-pic=" . $event_name . "_" . uniqid() . "." . $img_ex_lc;
                        
                        // Upload path
                        $img_upload_path = "../../Music-Event-Management-System/public/assets/images/events/" . $new_img_name;
    
                        // Move the uploaded image to the folder
                        move_uploaded_file($tmpName, $img_upload_path);
    
                        // Collect each new image name to store in the database
                        $imageNames[] = $new_img_name;
    
                    } else {
                        // Unsupported file type error
                        $msg = "You can't upload files of '" . $img_ex_lc;
                        $error = 'flag=1&msg=' . $msg . '&error_no=1';
                        // redirect("update-profile?id=$id&$error");
                        exit;
                    }
                } else {
                    // File size error
                    $msg = "File size exceeds the 2MB limit";
                    $error = 'flag=1&msg=' . $msg . '&error_no=1';
                    // redirect("update-profile?id=$id&$error");
                    exit;
                }
            }
    
            // Convert image names to JSON to store in the database
            $imagesJson = json_encode($imageNames);
            show($imagesJson);
    
            // Update the database with the JSON image names
            $event->update($id, ['cover_images' => $imageNames], 'id');
            // unset($_FILES);
    
            // Redirect to profile page
            // redirect("profile?id=$id&$success");
    
        } else {
            // No files uploaded error
            $msg = "No images were uploaded.";
            $error = 'flag=1&msg=' . $msg . '&error_no=1';
            redirect("update-profile?id=$id&$error");
        }
    }

}

