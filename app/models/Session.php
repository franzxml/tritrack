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
        $query = "INSERT INTO sessions (activity_id, start_time, session_date) 
                  VALUES (:activity_id, :start_time, :session_date)";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':activity_id', $data['activity_id']);
        $stmt->bindParam(':start_time', $data['start_time']);
        $stmt->bindParam(':session_date', $data['session_date']);
        $stmt->execute();
        return $this->connection->lastInsertId();
    }
    
    /**
     * Update session end time and duration
     * 
     * @param int $id Session ID
     * @param array $data Update data
     * @return bool
     */
    public function update($id, $data)
    {
        $query = "UPDATE sessions SET end_time = :end_time, duration_seconds = :duration 
                  WHERE id = :id";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':end_time', $data['end_time']);
        $stmt->bindParam(':duration', $data['duration_seconds']);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}