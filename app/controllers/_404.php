<?php 

class _404 {

    use Controller;
    use Model;
    
    public function index() {
        $this->view('404');
    }
}