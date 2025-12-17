<?php

/**
 * API Controller
 * Handles AJAX requests for timer operations
 * 
 * @package TriTrack
 * @author franzxml
 */

class ApiController extends Controller
{
    private $sessionModel;
    private $activityModel;
    private $summaryModel;
    
    /**
     * Constructor - Initialize models
     */
    public function __construct()
    {
        $this->sessionModel = $this->model('Session');
        $this->activityModel = $this->model('Activity');
        $this->summaryModel = $this->model('DailySummary');
        header('Content-Type: application/json');
    }
    
    /**
     * Save timer session with notes
     * 
     * @return void
     */
    public function saveSession()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false, 'message' => 'Invalid request method']);
            return;
        }
        
        $input = json_decode(file_get_contents('php://input'), true);
        $activity = $this->activityModel->getByName($input['activity']);
        
        if (!$activity) {
            echo json_encode(['success' => false, 'message' => 'Activity not found']);
            return;
        }
        
        $data = [
            'activity_id' => $activity['id'],
            'start_time' => date('Y-m-d H:i:s', strtotime('-' . $input['seconds'] . ' seconds')),
            'session_date' => date('Y-m-d'),
            'duration_seconds' => $input['seconds'],
            'notes' => $input['notes'] ?? null
        ];
        
        $sessionId = $this->sessionModel->create($data);
        $this->summaryModel->updateSummary(date('Y-m-d'));
        
        echo json_encode(['success' => true, 'session_id' => $sessionId]);
    }
    
    /**
     * Get activities list
     * 
     * @return void
     */
    public function getActivities()
    {
        $activities = $this->activityModel->getAll();
        echo json_encode(['success' => true, 'data' => $activities]);
    }
    
    /**
     * Get today's sessions
     * 
     * @return void
     */
    public function getTodaySessions()
    {
        $sessions = $this->sessionModel->getByDate(date('Y-m-d'));
        echo json_encode(['success' => true, 'data' => $sessions]);
    }
    
    /**
     * Update activity target time
     * 
     * @return void
     */
    public function updateTarget()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false, 'message' => 'Invalid request method']);
            return;
        }
        
        $input = json_decode(file_get_contents('php://input'), true);
        $result = $this->activityModel->updateTarget($input['activity_id'], $input['target_seconds']);
        
        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to update target']);
        }
    }
    
    /**
     * Get weekly summary
     * 
     * @return void
     */
    public function getWeeklySummary()
    {
        require_once '../app/helpers/DateHelper.php';
        $weekStart = DateHelper::getWeekStart();
        $weekEnd = DateHelper::getWeekEnd();
        
        $summaries = $this->summaryModel->getByDateRange($weekStart, $weekEnd);
        echo json_encode(['success' => true, 'data' => $summaries]);
    }
}