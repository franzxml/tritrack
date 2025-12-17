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
     * Save session to database with notes
     * 
     * @param {string} activity Activity name
     * @param {number} seconds Duration in seconds
     * @param {string} notes Session notes
     * @return {Promise}
     */
    async saveSession(activity, seconds, notes = null) {
        try {
            const response = await fetch(`${this.baseUrl}/ApiController/saveSession`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ activity, seconds, notes })
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
    },
    
    /**
     * Get today's sessions
     * 
     * @return {Promise}
     */
    async getTodaySessions() {
        try {
            const response = await fetch(`${this.baseUrl}/ApiController/getTodaySessions`);
            return await response.json();
        } catch (error) {
            console.error('API Error:', error);
            return { success: false, message: error.message };
        }
    },
    
    /**
     * Update activity target time
     * 
     * @param {number} activityId Activity ID
     * @param {number} targetSeconds Target seconds
     * @return {Promise}
     */
    async updateActivityTarget(activityId, targetSeconds) {
        try {
            const response = await fetch(`${this.baseUrl}/ApiController/updateTarget`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ activity_id: activityId, target_seconds: targetSeconds })
            });
            return await response.json();
        } catch (error) {
            console.error('API Error:', error);
            return { success: false, message: error.message };
        }
    },
    
    /**
     * Get weekly summary
     * 
     * @param {number} weekOffset Week offset (0 = current, -1 = last week)
     * @return {Promise}
     */
    async getWeeklySummary(weekOffset = 0) {
        try {
            const response = await fetch(`${this.baseUrl}/ApiController/getWeeklySummary?offset=${weekOffset}`);
            return await response.json();
        } catch (error) {
            console.error('API Error:', error);
            return { success: false, message: error.message };
        }
    }
};