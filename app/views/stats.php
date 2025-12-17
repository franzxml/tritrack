<?php
$appUrl = 'http://tritrack.test';
ob_start();
?>

<div class="stats-container">
    <div class="stats-header">
        <h2 class="stats-title">Today's Summary</h2>
        <a href="<?= $appUrl ?>" class="btn-back">← Back to Dashboard</a>
    </div>
    
    <div class="today-summary" id="todaySummary">
        <div class="summary-card">
            <h3>Total Time</h3>
            <p class="summary-value" id="totalTime">00:00:00</p>
        </div>
        <div class="summary-card">
            <h3>Sessions Count</h3>
            <p class="summary-value" id="sessionCount">0</p>
        </div>
        <div class="summary-card">
            <h3>Most Active</h3>
            <p class="summary-value" id="mostActive">-</p>
        </div>
    </div>
    
    <div class="activity-breakdown">
        <h3>Activity Breakdown</h3>
        <div class="breakdown-list" id="breakdownList"></div>
    </div>
    
    <div class="sessions-history">
        <h3>Today's Sessions</h3>
        <div class="sessions-list" id="sessionsList"></div>
    </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/layouts/main-layout.php';
?>