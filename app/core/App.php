<?php
class App{

    private $controller = 'Home';
    private $method = 'index';
    private function splitUrl(){
        $URL = $_GET['url'] ?? 'home';
        //$URL = explode("/", trim($URL,"/"));
        return $URL;
    }
    
    public function loadController(){

        $existsRoutes = $GLOBALS['router'];
        $URL = $this->splitURL();
        $routeValue = $URL;

        
        
        if (isset($existsRoutes[$routeValue])) {

            $routeData = $existsRoutes[$routeValue];

            $filename =  "../app/controllers/" . trim($routeData['class'], '/') . ".php";
            $className = basename($filename, ".php");
            $functionName = trim($routeData['function']);

            if (file_exists($filename)) {
                require $filename;
                $this->method = $functionName;
                $this->controller =  ucfirst($className);
            }
        } else {
            $filename =  "../app/controllers/_404.php";
            require $filename;
            $this->controller =  "_404";
        }


        $controller = new $this->controller;
        call_user_func_array([$controller, $this->method], []);
    }
}