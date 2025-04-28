<?php

use Twilio\Security\RequestValidator;

    class AboutUs {

        use Controller;

        public function index()
        {
            $data = [];
            $this->view('footer/aboutUs',$data,false);
        }
    }