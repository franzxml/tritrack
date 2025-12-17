<?php
$appUrl = 'http://tritrack.test';
ob_start();
?>

<div class="history-container">
    <div class="history-header">
        <h2 class="history-title">Activity History</h2>
        <a href="<?= $appUrl ?>" class="btn-back">← Back to Dashboard</a>
    </div>
    
    <div class="week-selector">
        <button class="btn-week-nav" id="prevWeek">← Previous Week</button>
        <span class="week-display" id="weekDisplay">Loading...</span>
        <button class="btn-week-nav" id="nextWeek">Next Week →</button>
    </div>
    
    <div class="weekly-chart">
        <canvas id="weeklyChart"></canvas>
    </div>
    
    <div class="weekly-summary">
        <h3>Weekly Summary</h3>
        <div class="summary-stats" id="weeklySummaryStats"></div>
    </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/layouts/main-layout.php';
?>