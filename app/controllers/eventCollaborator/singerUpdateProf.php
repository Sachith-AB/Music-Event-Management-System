<?php

class SingerUpdateProf {

    use Controller;
    use Model;

    public function index () {

        $user = new User;
        $data = [];

        $id = $_SESSION['USER']->id;
        $row = $user->firstById($id);

        if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['uploadImage']) && $_FILES['pro_pic']['name'] != ''){
            
            unset($_POST['uploadImage']);
            $this->uploadImage($user,$_FILES,$id);
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])){
            
            $this->updateDetail($user,$_POST,$id);
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['change-password'])){
            
            $data = $this->changePassword($user,$id);
        }
        $this->view('eventCollaborator/updateProfile',$data);
    }

    public function updateDetail($user,$POST,$id) {

        //Pass message
        $msg = "Profile updated Succesfully";
        $success = 'flag=' . 2 . '&msg=' . $msg . '&success_no=' . 1;

        //Update user
        $res = $user->update($id,$POST);
        unset($POST['update']);

        //Redirect to profile page
        redirect("colloborator-profile?id=$id&$success");
    }

    public function uploadImage ($user,$FILES,$id) {

        //Pass message
        $msg = "Profile updated Succesfully";
        $success = 'flag=' . 2 . '&msg=' . $msg . '&success_no=' . 1;

        if($FILES['pro_pic']['name'] != 'default-image.jpg'){

            $currentImagePath = ROOT . "/assets/user/pro-pic=".$id;
            //echo $currentImagePath;

            //Check if the file exists before attempting to delete it
            if (file_exists($currentImagePath)) {

                // Remove the current image
                unlink($currentImagePath);
            }

            $image_name = $_FILES['pro_pic']['name'];
            $tmp_name = $_FILES['pro_pic']['tmp_name'];
            $error = $_FILES['pro_pic']['error'];
            $size = $FILES['pro_pic']['size'];

            $max_size = 2 * 1024 * 1024; // 2MB in bytes

            if($error === 0 && $size < $max_size ){

                 // get image extention store it in variable
                $img_ex = pathinfo($image_name, PATHINFO_EXTENSION);
                

                // convet to image extetion into lowercase and store it in variable
                $img_ex_lc = strtolower($img_ex);

                // allowed image extetions
                $allowed_exs = array("jpg", "jpeg", "png");

                // check the allowed extention is present user upload image
                if(in_array($img_ex_lc,$allowed_exs)){
                    
                    //image name user id with image name
                    $new_img_name = "pro-pic=".$id.".".$img_ex_lc;
                    //echo $new_img_name;
                    
                    // creating upload path on root directory
                    $img_upload_path = "../../Music-Event-Management-System/public/assets/images/user/" . $new_img_name;

                    // move upload image for that folder
                    move_uploaded_file($tmp_name, $img_upload_path);

                    //update the databse image name
                    $user->update($id, ['pro_pic' => $new_img_name], 'id');

                    //Redirect to profile page
                    redirect("colloborator-profile?id=$id&$success");
                    
                }else {
                    
                    $msg = "You can't upload files of '" . $img_ex_lc;
                    $error = 'flag=' . 1 . '&msg=' . $msg . '&error_no=' . 1;
                    redirect("colloborator-updateprofile?id=$id&$error");
                    exit;
                }
            }else {
                    $msg = "File size exceeds the 2MB limit";
                    $error = 'flag=' . 1 . '&msg=' . $msg . '&error_no=' . 1;
                    redirect("colloborator-updateprofile?id=$id&$error");
                    exit;
            }
        }
    }

    private function changePassword($user,$id){
        $row = $user->firstById($id);

        if($user->changePassword($_POST)){
            unset($_POST['c-password']);
            $row = $user->firstById($id);

            $checkpassword = password_verify($_POST['password'], $row->password);
            
            if($checkpassword){
                $password = $_POST['n-password'];
                $hash = password_hash($password, PASSWORD_BCRYPT);
                $_POST['password'] = $hash;
                $user->update($id,$_POST);
                unset($_POST);
            }else{
                unset($_POST);
                $msg = 'Password Invalid';
                $flag = 1;
                $errors = 'msg='.$msg.'&flag='.$flag;
                redirect("update-profile?$errors");
            }
        }else{
            unset($_POST);
            return $user->errors;
        }
    }
}
