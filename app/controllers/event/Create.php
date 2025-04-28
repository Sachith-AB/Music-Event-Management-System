<?php

class Create {

    use Controller;

    public function index() {
        $event = new Event;
        $data = [];

        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
            // Create the event
            $data = $this->create($event, $_POST);
            
            // Only proceed if event creation was successful
            if(isset($data['success']) && $data['success']) {
                $event_name = $data['event_name'];
                
                // Check if files were uploaded - proper check for multiple files
                if(isset($_FILES['coverImage']) && is_array($_FILES['coverImage']['name']) && !empty($_FILES['coverImage']['name'][0])) {
                    // Prepare data for uploadImages with the uploaded files
                    $uploadData = $_POST;
                    $uploadData['cover_images'] = $_FILES['coverImage'];
                    $uploadData['event_name'] = $event_name;
                    
                    // Upload images and let that method handle the redirect
                    $this->uploadImages($event, $uploadData);
                } else {
                    // No images uploaded, redirect directly to review page
                    redirect("event-review?event_name=" . urlencode($event_name));
                    exit;
                }
            }
        }

        $this->view('event/createEvent', $data);
    }

    private function create($event, $POST){
        $event_name = $POST['event_name'];
        if($event->validEvent($POST)){
            $array['event_name'] = $event_name;
            $row = $event->first($array);

            if($row == 0){
                unset($POST['submit']); //remove submit key from POST array
                $event->insert($POST);
                
                // Return success without redirecting
                return ['success' => true, 'event_name' => $event_name];
            }else{
                $error = "Event name is already taken";
                $errors = 'flag=' . 1 . '&error=' . $error . '&error_no=' . 7;
                redirect("create-event?$errors");
                exit;
            }
        }else{
            return ['success' => false, 'errors' => $event->errors];
        }
    }
    
    public function uploadImages($event, $POST) {
        $event_name = $POST['event_name'];
        $imageNames = [];

        // Check if files are single or multiple
        if (is_array($POST['cover_images']['name'])) {
            // Multiple files uploaded
            $fileNames = $POST['cover_images']['name'];
            $tmpNames = $POST['cover_images']['tmp_name'];
            $errors = $POST['cover_images']['error'];
            $sizes = $POST['cover_images']['size'];
        } else {
            // Single file uploaded, normalize to arrays
            $fileNames = [$POST['cover_images']['name']];
            $tmpNames = [$POST['cover_images']['tmp_name']];
            $errors = [$POST['cover_images']['error']];
            $sizes = [$POST['cover_images']['size']];
        }

        // Process each file
        foreach ($fileNames as $index => $imageName) {
            if (empty($imageName)) continue; // Skip empty file inputs
            
            $tmpName = $tmpNames[$index];
            $error = $errors[$index];
            $size = $sizes[$index];
    
            $max_size = 10 * 1024 * 1024; // 5MB in bytes
    
            if ($error === 0 && $size < $max_size) {
                // Get image extension
                $img_ex = pathinfo($imageName, PATHINFO_EXTENSION);
                $img_ex_lc = strtolower($img_ex);
    
                // Allowed image extensions
                $allowed_exs = ["jpg", "jpeg", "png","avif"];
    
                if (in_array($img_ex_lc, $allowed_exs)) {
                    // Create a unique name for the image
                    $new_img_name = "event-pic=" . $event_name . "_" . uniqid() . "." . $img_ex_lc;
    
                    // Upload path - use absolute path for reliability
                    $upload_dir = dirname(dirname(dirname(dirname(__FILE__)))) . '/public/assets/images/events/';
                    
                    // Make sure the directory exists
                    if (!is_dir($upload_dir)) {
                        mkdir($upload_dir, 0777, true);
                    }
                    
                    $img_upload_path = $upload_dir . $new_img_name;
    
                    // Move the uploaded image to the folder
                    if (move_uploaded_file($tmpName, $img_upload_path)) {
                        $imageNames[] = $new_img_name; // Collect each new image name
                    } else {
                        // If move_uploaded_file fails, try to copy
                        if (copy($tmpName, $img_upload_path)) {
                            $imageNames[] = $new_img_name;
                        } else {
                            // Log the error
                            error_log("Failed to upload image: " . $imageName . " to " . $img_upload_path);
                        }
                    }
                } else {
                    // Unsupported file type error
                    $msg = "You can't upload files of type: '" . $img_ex_lc . "'";
                    redirect("create-event?error=$msg");
                    exit;
                }
            } else {
                // File size error
                $msg = "File size exceeds the 5MB limit for: " . $imageName;
                redirect("create-event?error=$msg");
                exit;
            }
        }
    
        // Convert image names to JSON to store in the database
        $imagesJson = json_encode($imageNames);
    
        // Get the event by name and update it
        $result = $event->where(['event_name' => $event_name]);
        if (is_array($result) && !empty($result)) {
            $id = $result[0]->id;
            // Update the database with the JSON image names
            $event->update($id, ['cover_images' => $imagesJson], 'id');
            
            // Redirect to event review - ensure this is executed
            redirect("event-review?event_name=" . urlencode($event_name));
            exit;
        } else {
            // If we can't find the event, redirect back with an error
            $msg = "Could not find the event to attach images to.";
            redirect("create-event?error=$msg");
            exit;
        }
    }
}
