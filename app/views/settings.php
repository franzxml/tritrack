<?php
$appUrl = 'http://tritrack.test';
ob_start();
?>

<div class="settings-container">
    <div class="settings-header">
        <h2 class="settings-title">Settings</h2>
        <a href="<?= $appUrl ?>" class="btn-back">← Back to Dashboard</a>
    </div>
    
    <div class="settings-section">
        <h3 class="section-title">Daily Time Targets</h3>
        <p class="section-description">Set your target time for each activity per day</p>
        
        <div class="targets-grid">
            <?php foreach ($activities as $activity): ?>
            <div class="target-card" data-activity-id="<?= $activity['id'] ?>">
                <h4 class="target-activity"><?= htmlspecialchars($activity['display_name']) ?></h4>
                <div class="target-input-group">
                    <input type="number" class="target-input" 
                           value="<?= floor($activity['target_seconds'] / 3600) ?>" 
                           min="0" max="24" data-field="hours">
                    <span class="target-label">hours</span>
                    <input type="number" class="target-input" 
                           value="<?= floor(($activity['target_seconds'] % 3600) / 60) ?>" 
                           min="0" max="59" data-field="minutes">
                    <span class="target-label">minutes</span>
                </div>
                <button class="btn-save-target" onclick="window.settingsManager.saveTarget(<?= $activity['id'] ?>)">
                    Save
                </button>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    
    <div class="settings-section">
        <h3 class="section-title">Notifications</h3>
        <p class="section-description">Manage notification preferences</p>
        
        <div class="notification-settings">
            <div class="setting-item">
                <label class="setting-label">
                    <input type="checkbox" id="notifyTimeLimit" checked>
                    <span>Notify when time limit is reached</span>
                </label>
            </div>
            <div class="setting-item">
                <label class="setting-label">
                    <input type="checkbox" id="notifySwitch" checked>
                    <span>Remind to switch activities</span>
                </label>
            </div>
            <button class="btn-test-notification" onclick="window.settingsManager.testNotification()">
                Test Notification
            </button>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/layouts/main-layout.php';
?>