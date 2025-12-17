<?php

/**
 * Daily Summary Model
 * Handles daily summary operations
 * 
 * @package TriTrack
 * @author franzxml
 */

class DailySummary
{
    private $db;
    private $connection;
    
    /**
     * Constructor - Initialize database connection
     */
    public function __construct()
    {
        $this->db = new Database();
        $this->connection = $this->db->getConnection();
    }
    
    /**
     * Create or update daily summary
     * 
     * @param string $date Date in Y-m-d format
     * @return bool
     */
    public function updateSummary($date)
    {
        $query = "INSERT INTO daily_summaries (summary_date, total_seconds, activities_count)
                  SELECT :date, SUM(duration_seconds), COUNT(DISTINCT activity_id)
                  FROM sessions WHERE session_date = :date2
                  ON DUPLICATE KEY UPDATE 
                  total_seconds = VALUES(total_seconds),
                  activities_count = VALUES(activities_count)";
        
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':date2', $date);
        return $stmt->execute();
    }
    
    /**
     * Get summary by date
     * 
     * @param string $date Date in Y-m-d format
     * @return array|false
     */
    public function getByDate($date)
    {
        $query = "SELECT * FROM daily_summaries WHERE summary_date = :date";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':date', $date);
        $stmt->execute();
        return $stmt->fetch();
    }
    
    /**
     * Get summaries by date range
     * 
     * @param string $startDate Start date
     * @param string $endDate End date
     * @return array
     */
    public function getByDateRange($startDate, $endDate)
    {
        $query = "SELECT * FROM daily_summaries 
                  WHERE summary_date BETWEEN :start AND :end 
                  ORDER BY summary_date ASC";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':start', $startDate);
        $stmt->bindParam(':end', $endDate);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}