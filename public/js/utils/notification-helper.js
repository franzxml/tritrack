/**
 * Notification Helper Utility
 * Handle browser notifications and alerts
 * 
 * @package TriTrack
 * @author franzxml
 */

const NotificationHelper = {
    /**
     * Check if notifications are supported
     * 
     * @return {boolean}
     */
    isSupported() {
        return 'Notification' in window;
    },
    
    /**
     * Request notification permission
     * 
     * @return {Promise}
     */
    async requestPermission() {
        if (!this.isSupported()) {
            return false;
        }
        
        if (Notification.permission === 'granted') {
            return true;
        }
        
        const permission = await Notification.requestPermission();
        return permission === 'granted';
    },
    
    /**
     * Show notification
     * 
     * @param {string} title Notification title
     * @param {string} body Notification body
     * @param {string} icon Icon URL
     */
    async show(title, body, icon = null) {
        const hasPermission = await this.requestPermission();
        
        if (!hasPermission) {
            this.showFallbackAlert(title, body);
            return;
        }
        
        const options = {
            body: body,
            icon: icon || '/assets/images/icon.png',
            badge: icon || '/assets/images/icon.png',
            vibrate: [200, 100, 200],
            tag: 'tritrack-notification'
        };
        
        new Notification(title, options);
    },
    
    /**
     * Show fallback alert
     * 
     * @param {string} title Alert title
     * @param {string} body Alert body
     */
    showFallbackAlert(title, body) {
        alert(`${title}\n\n${body}`);
    },
    
    /**
     * Show time limit notification
     * 
     * @param {string} activity Activity name
     */
    showTimeLimitReached(activity) {
        this.show(
            'Time Limit Reached!',
            `You've reached your daily target for ${activity}. Consider switching activities.`
        );
    },
    
    /**
     * Show switch reminder
     * 
     * @param {string} currentActivity Current activity
     * @param {string} nextActivity Next activity
     */
    showSwitchReminder(currentActivity, nextActivity) {
        this.show(
            'Time to Switch Activities',
            `You've been on ${currentActivity} for a while. Consider switching to ${nextActivity}.`
        );
    }
};