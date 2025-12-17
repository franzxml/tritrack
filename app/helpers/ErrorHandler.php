<?php

/**
 * Error Handler Helper
 * Handle application errors and logging
 * 
 * @package TriTrack
 * @author franzxml
 */

class ErrorHandler
{
    /**
     * Log error to file
     * 
     * @param string $message Error message
     * @param string $level Error level
     * @return void
     */
    public static function log($message, $level = 'ERROR')
    {
        $logFile = '../storage/logs/app.log';
        $timestamp = date('Y-m-d H:i:s');
        $logMessage = "[{$timestamp}] [{$level}] {$message}\n";
        
        if (!file_exists('../storage/logs')) {
            mkdir('../storage/logs', 0755, true);
        }
        
        file_put_contents($logFile, $logMessage, FILE_APPEND);
    }
    
    /**
     * Handle exceptions
     * 
     * @param Exception $e Exception object
     * @return void
     */
    public static function handleException($e)
    {
        self::log($e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine());
        
        if (self::isDevelopment()) {
            echo '<pre>' . $e->getMessage() . '</pre>';
        } else {
            echo 'An error occurred. Please try again later.';
        }
    }
    
    /**
     * Check if in development mode
     * 
     * @return bool
     */
    private static function isDevelopment()
    {
        $config = require_once '../app/config/config.php';
        return $config['environment'] === 'development';
    }
}