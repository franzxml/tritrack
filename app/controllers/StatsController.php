<?php

/**
 * Statistics Controller
 * Handles statistics and history views
 * 
 * @package TriTrack
 * @author franzxml
 */

class StatsController extends Controller
{
    /**
     * Display statistics page
     * 
     * @return void
     */
    public function index()
    {
        $data = [
            'title' => 'Statistics - TriTrack',
            'page' => 'statistics'
        ];
        
        $this->view('stats', $data);
    }
}