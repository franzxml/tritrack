/**
 * API Helper Utility
 * Handle AJAX requests to backend
 * 
 * @package TriTrack
 * @author franzxml
 */

const ApiHelper = {
    /**
     * Base URL for API requests
     */
    baseUrl: 'http://tritrack.test',
    
    /**
     * Save session to database
     * 
     * @param {string} activity Activity name
     * @param {number} seconds Duration in seconds
     * @return {Promise}
     */
    async saveSession(activity, seconds) {
        try {
            const response = await fetch(`${this.baseUrl}/ApiController/saveSession`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ activity, seconds })
            });
            return await response.json();
        } catch (error) {
            console.error('API Error:', error);
            return { success: false, message: error.message };
        }
    },
    
    /**
     * Get all activities
     * 
     * @return {Promise}
     */
    async getActivities() {
        try {
            const response = await fetch(`${this.baseUrl}/ApiController/getActivities`);
            return await response.json();
        } catch (error) {
            console.error('API Error:', error);
            return { success: false, message: error.message };
        }
    }
};