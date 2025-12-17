/**
 * Dashboard Timer Component
 * Manages activity timers
 * 
 * @package TriTrack
 * @author franzxml
 */

class TimerManager {
    /**
     * Initialize timer manager
     */
    constructor() {
        this.timers = {};
        this.initializeTimers();
        this.attachEventListeners();
    }
    
    /**
     * Initialize all timer cards
     */
    initializeTimers() {
        const cards = document.querySelectorAll('.timer-card');
        cards.forEach(card => {
            const activity = card.dataset.activity;
            this.timers[activity] = {
                seconds: 0,
                interval: null,
                isRunning: false
            };
        });
    }
    
    /**
     * Attach event listeners to buttons
     */
    attachEventListeners() {
        const cards = document.querySelectorAll('.timer-card');
        cards.forEach(card => {
            const activity = card.dataset.activity;
            const btnStart = card.querySelector('.btn-start');
            const btnPause = card.querySelector('.btn-pause');
            const btnStop = card.querySelector('.btn-stop');
            
            btnStart.addEventListener('click', () => this.startTimer(activity));
            btnPause.addEventListener('click', () => this.pauseTimer(activity));
            btnStop.addEventListener('click', () => this.stopTimer(activity));
        });
    }
}

// Initialize on DOM load
document.addEventListener('DOMContentLoaded', () => {
    new TimerManager();
});