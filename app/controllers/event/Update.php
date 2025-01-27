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
        // show($row);


        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])){
            
            $this->updateDetail($event);
        }
        // if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['upload'])){
        //     $this->uploadImages($event,$_FILES);
        //     show($_FILES);
        // }

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

        // show($_POST);

        
        redirect("event-review?event_name=$event_name");
    }

    // public function uploadImages($event, $FILES) {
    //     $id = $_POST['event_id'];
    //     $event_name = htmlspecialchars($_GET['event_name']);
    //     $imageNames = [];

    //     // Check if files are single or multiple
    //     if (is_array($FILES['cover_images']['name'])) {
            
    //         $fileNames = $FILES['cover_images']['name'];
    //         $tmpNames = $FILES['cover_images']['tmp_name'];
    //         $errors = $FILES['cover_images']['error'];
    //         $sizes = $FILES['cover_images']['size'];
    //     } else {
    //         // Single file uploaded, normalize to arrays
    //         $fileNames = [$FILES['cover_images']['name']];
    //         $tmpNames = [$FILES['cover_images']['tmp_name']];
    //         $errors = [$FILES['cover_images']['error']];
    //         $sizes = [$FILES['cover_images']['size']];
    //     }

        // Check if files are single or multiple
        // if (is_array($FILES['cover_images']['name'])) {
        //     // Multiple files uploaded
        //     $fileNames = $FILES['cover_images']['name'];
        //     $tmpNames = $FILES['cover_images']['tmp_name'];
        //     $errors = $FILES['cover_images']['error'];
        //     $sizes = $FILES['cover_images']['size'];
        // } else {
        //     // Single file uploaded, normalize to arrays
        //     $fileNames = [$FILES['cover_images']['name']];
        //     $tmpNames = [$FILES['cover_images']['tmp_name']];
        //     $errors = [$FILES['cover_images']['error']];
        //     $sizes = [$FILES['cover_images']['size']];
        // }

    
    //     // Process each file
    //     foreach ($fileNames as $index => $imageName) {
    //         $tmpName = $tmpNames[$index];
    //         $error = $errors[$index];
    //         $size = $sizes[$index];
    
    //         $max_size = 2 * 1024 * 1024; // 2MB in bytes
    
    //         if ($error === 0 && $size < $max_size) {
    //             // Get image extension
    //             $img_ex = pathinfo($imageName, PATHINFO_EXTENSION);
    //             $img_ex_lc = strtolower($img_ex);
    
    //             // Allowed image extensions
    //             $allowed_exs = ["jpg", "jpeg", "png"];
    
    //             if (in_array($img_ex_lc, $allowed_exs)) {
    //                 // Create a unique name for the image
    //                 $new_img_name = "event-pic=" . $event_name . "_" . uniqid() . "." . $img_ex_lc;
    
    //                 // Upload path
    //                 $img_upload_path = "../../Music-Event-Management-System/public/assets/images/events/" . $new_img_name;
    
    //                 // Move the uploaded image to the folder
    //                 if (move_uploaded_file($tmpName, $img_upload_path)) {
    //                     $imageNames[] = $new_img_name; // Collect each new image name
    //                 }
    //             } else {
    //                 // Unsupported file type error
    //                 $msg = "You can't upload files of type: '" . $img_ex_lc . "'";
    //                 redirect("update-event?id=$id&error=$msg");
    //                 return;
    //             }
    //         } else {
    //             // File size error
    //             $msg = "File size exceeds the 2MB limit for: " . $imageName;
    //             redirect("update-event?id=$id&error=$msg");
    //             return;
    //         }
    //     }
    
    //     // Convert image names to JSON to store in the database
    //     $imagesJson = json_encode($imageNames);
    
    //     // Update the database with the JSON image names
    //     $event->update($id, ['cover_images' => $imagesJson], 'id');
    
    //     // Redirect to event review page
    //     redirect("event-review?event_name=$event_name");
    // }
    
}

