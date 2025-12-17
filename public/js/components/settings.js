/**
 * Settings Component
 * Manage application settings
 * 
 * @package TriTrack
 * @author franzxml
 */

class SettingsManager {
    /**
     * Initialize settings manager
     */
    constructor() {
        this.loadSettings();
        this.attachEventListeners();
    }
    
    /**
     * Load saved settings
     */
    loadSettings() {
        const notifyTimeLimit = localStorage.getItem('tritrack_notify_time_limit');
        const notifySwitch = localStorage.getItem('tritrack_notify_switch');
        
        if (notifyTimeLimit !== null) {
            document.getElementById('notifyTimeLimit').checked = notifyTimeLimit === 'true';
        }
        if (notifySwitch !== null) {
            document.getElementById('notifySwitch').checked = notifySwitch === 'true';
        }
    }
    
    /**
     * Attach event listeners
     */
    attachEventListeners() {
        document.getElementById('notifyTimeLimit').addEventListener('change', (e) => {
            localStorage.setItem('tritrack_notify_time_limit', e.target.checked);
        });
        
        document.getElementById('notifySwitch').addEventListener('change', (e) => {
            localStorage.setItem('tritrack_notify_switch', e.target.checked);
        });
    }
    
    /**
     * Save activity target
     * 
     * @param {number} activityId Activity ID
     */
    async saveTarget(activityId) {
        const card = document.querySelector(`[data-activity-id="${activityId}"]`);
        const hours = parseInt(card.querySelector('[data-field="hours"]').value);
        const minutes = parseInt(card.querySelector('[data-field="minutes"]').value);
        const totalSeconds = (hours * 3600) + (minutes * 60);
        
        const response = await ApiHelper.updateActivityTarget(activityId, totalSeconds);
        
        if (response.success) {
            this.showSuccessMessage('Target updated successfully!');
        } else {
            this.showErrorMessage('Failed to update target');
        }
    }
    
    /**
     * Test notification
     */
    async testNotification() {
        await NotificationHelper.show(
            'TriTrack Notification',
            'This is a test notification. Your notifications are working!'
        );
    }
    
    /**
     * Show success message
     * 
     * @param {string} message Success message
     */
    showSuccessMessage(message) {
        alert(message);
    }
    
    /**
     * Show error message
     * 
     * @param {string} message Error message
     */
    showErrorMessage(message) {
        alert(message);
    }
}

window.settingsManager = new SettingsManager();