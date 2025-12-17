<?php

/**
 * Base Controller Class
 * Parent class for all controllers
 * 
 * @package TriTrack
 * @author franzxml
 */

class Controller
{
    /**
     * Load view file
     * 
     * @param string $view View file path
     * @param array $data Data to pass to view
     * @return void
     */
    protected function view($view, $data = [])
    {
        extract($data);
        require_once "../app/views/{$view}.php";
    }
    
    /**
     * Load model
     * 
     * @param string $model Model name
     * @return object
     */
    protected function model($model)
    {
        require_once "../app/models/{$model}.php";
        return new $model();
    }
}