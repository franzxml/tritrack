<?php

/**
 * Application Entry Point
 * 
 * @package TriTrack
 * @author franzxml
 */

// Start session
session_start();

// Load core classes
require_once '../app/core/App.php';
require_once '../app/core/Controller.php';
require_once '../app/core/Database.php';

// Load configuration
$config = require_once '../app/config/config.php';
date_default_timezone_set($config['timezone']);

// Initialize application
$app = new App();