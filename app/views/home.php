<?php
$appUrl = 'http://tritrack.test';
ob_start();
?>

<div class="dashboard-container">
    <div class="dashboard-actions">
        <a href="<?= $appUrl ?>/StatsController" class="btn-stats">View Statistics</a>
        <a href="<?= $appUrl ?>/HistoryController" class="btn-history">History</a>
        <a href="<?= $appUrl ?>/SettingsController" class="btn-settings">Settings</a>
    </div>
    
    <div class="timer-grid">
        <div class="timer-card" data-activity="honkai">
            <h2 class="timer-title">Honkai: Star Rail</h2>
            <div class="timer-display">00:00:00</div>
            <div class="timer-controls">
                <button class="btn-start">Start</button>
                <button class="btn-pause" disabled>Pause</button>
                <button class="btn-stop" disabled>Stop</button>
            </div>
            <div class="progress-bar">
                <div class="progress-fill"></div>
            </div>
        </div>
        
        <div class="timer-card" data-activity="gta">
            <h2 class="timer-title">GTA V</h2>
            <div class="timer-display">00:00:00</div>
            <div class="timer-controls">
                <button class="btn-start">Start</button>
                <button class="btn-pause" disabled>Pause</button>
                <button class="btn-stop" disabled>Stop</button>
            </div>
            <div class="progress-bar">
                <div class="progress-fill"></div>
            </div>
        </div>
        
        <div class="timer-card" data-activity="coding">
            <h2 class="timer-title">Coding</h2>
            <div class="timer-display">00:00:00</div>
            <div class="timer-controls">
                <button class="btn-start">Start</button>
                <button class="btn-pause" disabled>Pause</button>
                <button class="btn-stop" disabled>Stop</button>
            </div>
            <div class="progress-bar">
                <div class="progress-fill"></div>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/layouts/main-layout.php';
?>