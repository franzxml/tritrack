<?php

/**
 * Application Router Core
 * Handles URL routing and controller loading
 * 
 * @package TriTrack
 * @author franzxml
 */

class App
{
    protected $controller = 'HomeController';
    protected $method = 'index';
    protected $params = [];
    
    /**
     * Parse URL and route to controller
     */
    public function __construct()
    {
        $url = $this->parseUrl();
        
        if (isset($url[0]) && file_exists("../app/controllers/{$url[0]}.php")) {
            $this->controller = $url[0];
            unset($url[0]);
        }
        
        $controllerPath = "../app/controllers/{$this->controller}.php";
        
        if (!file_exists($controllerPath)) {
            $this->show404();
            return;
        }
        
        require_once $controllerPath;
        $this->controller = new $this->controller;
        
        if (isset($url[1]) && method_exists($this->controller, $url[1])) {
            $this->method = $url[1];
            unset($url[1]);
        }
        
        $this->params = $url ? array_values($url) : [];
        call_user_func_array([$this->controller, $this->method], $this->params);
    }
    
    /**
     * Parse URL from request
     * 
     * @return array|null
     */
    private function parseUrl()
    {
        if (isset($_GET['url'])) {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
        return null;
    }
    
    /**
     * Show 404 error page
     * 
     * @return void
     */
    private function show404()
    {
        http_response_code(404);
        require_once '../app/views/404.php';
        exit;
    }
}