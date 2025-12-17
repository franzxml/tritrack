<?php

/**
 * History Controller
 * Handles history and weekly views
 * 
 * @package TriTrack
 * @author franzxml
 */

class HistoryController extends Controller
{
    /**
     * Display history page
     * 
     * @return void
     */
    public function index()
    {
        $data = [
            'title' => 'History - TriTrack',
            'page' => 'history'
        ];
        
        $this->view('history', $data);
    }
}