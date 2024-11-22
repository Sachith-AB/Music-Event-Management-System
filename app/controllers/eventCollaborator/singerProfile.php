<?php 

class SingerProfile {

    use Controller;
    use Model;

    public function index()
    {
        $user = new User;

        $data = $this->profile($user);
        // show( $data);
        $this->view('eventCollaborator/singerProfile',['data'=>$data]);

    }

    public function profile($user){

        $id = $_SESSION['USER']->id ?? 0;
        //echo $id;

        $row = $user->firstById($id);
        $data = json_decode(json_encode($row),true);
        $_SESSION['USER'] = $row;
        //show($data) ;


        return $data;
        //show($row);
    }
   
}