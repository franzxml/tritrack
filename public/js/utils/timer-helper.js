/**
 * Timer Helper Utility
 * Format and calculate timer values
 * 
 * @package TriTrack
 * @author franzxml
 */

const TimerHelper = {
    /**
     * Format seconds to HH:MM:SS
     * 
     * @param {number} totalSeconds Total seconds
     * @return {string} Formatted time string
     */
    formatTime(totalSeconds) {
        const hours = Math.floor(totalSeconds / 3600);
        const minutes = Math.floor((totalSeconds % 3600) / 60);
        const seconds = totalSeconds % 60;
        
        return `${this.pad(hours)}:${this.pad(minutes)}:${this.pad(seconds)}`;
    },
    
    /**
     * Pad number with leading zero
     * 
     * @param {number} num Number to pad
     * @return {string} Padded string
     */
    pad(num) {
        return num.toString().padStart(2, '0');
    },
    
    /**
     * Calculate progress percentage
     * 
     * @param {number} current Current seconds
     * @param {number} target Target seconds
     * @return {number} Progress percentage
     */
    calculateProgress(current, target) {
        if (target === 0) return 0;
        return Math.min((current / target) * 100, 100);
    }
};