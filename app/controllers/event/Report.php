<?php

    class Report {

        use Controller;

        public function index()
        {
            $this->view('event/eventReport');
        }
    }