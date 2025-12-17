<?php

/**
 * Settings Controller
 * Handles application settings
 * 
 * @package TriTrack
 * @author franzxml
 */

class SettingsController extends Controller
{
    /**
     * Display settings page
     * 
     * @return void
     */
    public function index()
    {
        $activityModel = $this->model('Activity');
        $activities = $activityModel->getAll();
        
        $data = [
            'title' => 'Settings - TriTrack',
            'page' => 'settings',
            'activities' => $activities
        ];
        
        $this->view('settings', $data);
    }
}