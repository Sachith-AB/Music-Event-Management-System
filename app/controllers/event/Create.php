
<?php

class Create {

    use Controller;

    public function index() {
        $event = new Event;
        $data = [];


        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
            //show($_POST);

            $data = $this->create($event,$_POST);
            // show($data);
        }



        $this->view('event/createEvent',$data);

        

    }

    private function create($event, $POST){
        $event_name = $POST['event_name'];
        if($event->validEvent($_POST)){
            $array['event_name'] = $event_name;
            $row = $event->first($array);

            if($row == 0){
                unset($POST['submit']); //remove submit key from POST array
                $event->insert($_POST);
                //show($event_name);
                //show ($_POST);
                redirect("event-review?event_name=$event_name");


            }else{
                $error = "Event name is already taken";
                $errors = 'flag=' . 1 . '&error=' . $error . '&error_no=' . 7 ;
                redirect("create-event?$errors");
                exit;
            }
        }else{
            return $event->errors;
        }

    }
    

    // public function uploadImages($event, $POST) {
    //     $id = $_POST['event_id'];
    //     $event_name = htmlspecialchars($_GET['event_name']);
    //     $imageNames = [];

    //     // Check if files are single or multiple
    //     if (is_array($POST['cover_images']['name'])) {
            
    //         $fileNames = $POST['cover_images']['name'];
    //         $tmpNames = $POST['cover_images']['tmp_name'];
    //         $errors = $POST['cover_images']['error'];
    //         $sizes = $POST['cover_images']['size'];
    //     } else {
    //         // Single file uploaded, normalize to arrays
    //         $fileNames = [$POST['cover_images']['name']];
    //         $tmpNames = [$POST['cover_images']['tmp_name']];
    //         $errors = [$POST['cover_images']['error']];
    //         $sizes = [$POST['cover_images']['size']];
    //     }

    //     //Check if files are single or multiple
    //     if (is_array($POST['cover_images']['name'])) {
    //         // Multiple files uploaded
    //         $fileNames = $POST['cover_images']['name'];
    //         $tmpNames = $POST['cover_images']['tmp_name'];
    //         $errors = $POST['cover_images']['error'];
    //         $sizes = $POST['cover_images']['size'];
    //     } else {
    //         // Single file uploaded, normalize to arrays
    //         $fileNames = [$POST['cover_images']['name']];
    //         $tmpNames = [$POST['cover_images']['tmp_name']];
    //         $errors = [$POST['cover_images']['error']];
    //         $sizes = [$POST['cover_images']['size']];
    //     }

    
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
