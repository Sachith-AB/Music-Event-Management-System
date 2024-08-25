<?php

class UpdateProf {

    use Controller;
    use Model;

    public function index () {

        $user = new User;
        $data = [];
        $success = '';

        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['uploadImage'])){

            //$this->uploadImage();
            //echo "check";
            //show($_FILES);
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])){
            
            $this->updateDetail($user,$_POST);
            //show($_POST);
        }
        $data = $this->getData($user);
        $this->view('ticketHolder/updateProfile',$data);
    }

    public function getData($user) {

        $id = htmlspecialchars($_GET['id']);
        
        $row = $user->firstById($id);
        //show($row);
        $data = json_decode(json_encode($row),true);
        return $data;


    }

    public function updateDetail($user,$POST) {

        $id = htmlspecialchars($_GET['id']);
        $msg = "Profile updated Succesfully";
        $success = 'flag=' . 2 . '&msg=' . $msg . '&success_no=' . 1;
        $res = $user->update($id,$POST);
        unset($POST['update']);
        redirect("profile?id=$id&$success");
    }

    public function uploadImage () {

        if(isset($_FILES['pro_pic'])){

            //echo "check";
            $image = $_FILES['pro_pic'];
            $directory = ROOT.'/assets/images/user/pro-pic/';
            $fileTmpName = $image['tmp_name'];
            
            $id = htmlspecialchars($_GET['id']);

            //Generate a random name for the image
            $fileExtension = pathinfo($image['name'], PATHINFO_EXTENSION); // Extract extension
            $randomName = "pro_pic_id=".$id."_" .rand(00000,99999) . "." . $fileExtension;
            

            // Set the target path with the new random name
            $targetPath = $directory . $randomName;

            //validate file type
            $allowedTypes = ['image/png', 'image/jpeg'];

            if($image != ""){
                if(in_array($image['type'],$allowedTypes)){
                    if($image['size'] < 5000000){ //5MB limit
                        if (move_uploaded_file($fileTmpName, $targetPath)) {
                            echo "File uploaded successfully with name: $randomName";
                        } else {
                            //echo "Failed to move the uploaded file.";
                            unset($_FILES['pro_pic']);
                        }
                    }else {
                        echo "File too large";
                        unset($_FILES['pro_pic']);
                    }
                } else {
                    echo "Invalid file type";
                    unset($_FILES['pro_pic']);
                }
            }else {
                return false;
            }
            
            

        }else {
            return false;
        }
    }
}