<?php

    class Privacy {

        use Controller;

        public function index()
        {
            $data = [];
            $this->view('footer/privacy',$data,false);
        }
    }