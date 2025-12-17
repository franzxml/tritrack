<?php

/**
 * Home Controller
 * Handles main dashboard and home page
 * 
 * @package TriTrack
 * @author franzxml
 */

class HomeController extends Controller
{
    /**
     * Display dashboard page
     * 
     * @return void
     */
    public function index()
    {
        $data = [
            'title' => 'Dashboard - TriTrack',
            'page' => 'dashboard'
        ];
        
        $this->view('home', $data);
    }
}