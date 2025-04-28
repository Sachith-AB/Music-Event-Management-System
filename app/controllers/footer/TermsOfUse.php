<?php

    class TermsOfUse {

        use Controller;

        public function index()
        {
            $data = [];
            $this->view('footer/termsOfUse', $data, false);
        }
    }