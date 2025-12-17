<?php

/**
 * Activity Model
 * Handles activity data operations
 * 
 * @package TriTrack
 * @author franzxml
 */

class Activity
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
     * Get all activities
     * 
     * @return array
     */
    public function getAll()
    {
        $query = "SELECT * FROM activities ORDER BY id ASC";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    /**
     * Get activity by name
     * 
     * @param string $name Activity name
     * @return array|false
     */
    public function getByName($name)
    {
        $query = "SELECT * FROM activities WHERE name = :name";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->execute();
        return $stmt->fetch();
    }
    
    /**
     * Update activity target time
     * 
     * @param int $id Activity ID
     * @param int $targetSeconds Target seconds
     * @return bool
     */
    public function updateTarget($id, $targetSeconds)
    {
        $query = "UPDATE activities SET target_seconds = :target WHERE id = :id";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':target', $targetSeconds);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}