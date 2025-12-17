<?php

/**
 * Database Core Class
 * Handles database connection using PDO
 * 
 * @package TriTrack
 * @author franzxml
 */

class Database
{
    private $connection;
    
    /**
     * Constructor - Initialize database connection
     */
    public function __construct()
    {
        $config = require_once '../app/config/database.php';
        
        try {
            $dsn = "mysql:host={$config['host']};dbname={$config['database']};charset={$config['charset']}";
            $this->connection = new PDO($dsn, $config['username'], $config['password'], $config['options']);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }
    
    /**
     * Get database connection instance
     * 
     * @return PDO
     */
    public function getConnection()
    {
        return $this->connection;
    }
}