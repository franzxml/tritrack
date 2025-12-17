<?php

/**
 * Session Model
 * Handles session data operations
 * 
 * @package TriTrack
 * @author franzxml
 */

class Session
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
     * Create new session
     * 
     * @param array $data Session data
     * @return int Last insert ID
     */
    public function create($data)
    {
        $query = "INSERT INTO sessions (activity_id, start_time, session_date, end_time, duration_seconds) 
                  VALUES (:activity_id, :start_time, :session_date, NOW(), :duration)";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':activity_id', $data['activity_id']);
        $stmt->bindParam(':start_time', $data['start_time']);
        $stmt->bindParam(':session_date', $data['session_date']);
        $duration = isset($data['duration_seconds']) ? $data['duration_seconds'] : 0;
        $stmt->bindParam(':duration', $duration);
        $stmt->execute();
        return $this->connection->lastInsertId();
    }
    
    /**
     * Get sessions by date
     * 
     * @param string $date Date in Y-m-d format
     * @return array
     */
    public function getByDate($date)
    {
        $query = "SELECT s.*, a.name, a.display_name 
                  FROM sessions s 
                  JOIN activities a ON s.activity_id = a.id 
                  WHERE s.session_date = :date 
                  ORDER BY s.start_time DESC";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':date', $date);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}