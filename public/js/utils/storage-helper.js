/**
 * Storage Helper Utility
 * Handle localStorage operations
 * 
 * @package TriTrack
 * @author franzxml
 */

const StorageHelper = {
    /**
     * Save timer data to localStorage
     * 
     * @param {string} activity Activity name
     * @param {object} data Timer data
     */
    saveTimer(activity, data) {
        const key = `tritrack_${activity}`;
        localStorage.setItem(key, JSON.stringify(data));
    },
    
    /**
     * Load timer data from localStorage
     * 
     * @param {string} activity Activity name
     * @return {object|null} Timer data or null
     */
    loadTimer(activity) {
        const key = `tritrack_${activity}`;
        const data = localStorage.getItem(key);
        return data ? JSON.parse(data) : null;
    },
    
    /**
     * Clear timer data
     * 
     * @param {string} activity Activity name
     */
    clearTimer(activity) {
        const key = `tritrack_${activity}`;
        localStorage.removeItem(key);
    },
    
    /**
     * Get today's date key
     * 
     * @return {string} Date key YYYY-MM-DD
     */
    getTodayKey() {
        const today = new Date();
        return today.toISOString().split('T')[0];
    }
};