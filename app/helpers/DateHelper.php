<?php

/**
 * Date Helper
 * Utility functions for date operations
 * 
 * @package TriTrack
 * @author franzxml
 */

class DateHelper
{
    /**
     * Get start of week date
     * 
     * @param string $date Date string
     * @return string Y-m-d format
     */
    public static function getWeekStart($date = null)
    {
        $timestamp = $date ? strtotime($date) : time();
        $dayOfWeek = date('w', $timestamp);
        $diff = $dayOfWeek - 1;
        if ($diff < 0) $diff = 6;
        return date('Y-m-d', strtotime("-{$diff} days", $timestamp));
    }
    
    /**
     * Get end of week date
     * 
     * @param string $date Date string
     * @return string Y-m-d format
     */
    public static function getWeekEnd($date = null)
    {
        $weekStart = self::getWeekStart($date);
        return date('Y-m-d', strtotime('+6 days', strtotime($weekStart)));
    }
    
    /**
     * Get date range for last N days
     * 
     * @param int $days Number of days
     * @return array [start_date, end_date]
     */
    public static function getLastNDays($days)
    {
        $endDate = date('Y-m-d');
        $startDate = date('Y-m-d', strtotime("-{$days} days"));
        return [$startDate, $endDate];
    }
    
    /**
     * Format seconds to human readable
     * 
     * @param int $seconds Total seconds
     * @return string Formatted string
     */
    public static function formatDuration($seconds)
    {
        $hours = floor($seconds / 3600);
        $minutes = floor(($seconds % 3600) / 60);
        
        if ($hours > 0) {
            return "{$hours}h {$minutes}m";
        }
        return "{$minutes}m";
    }
}