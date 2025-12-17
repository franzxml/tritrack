/**
 * Dashboard Timer Component
 * Manages activity timers
 * 
 * @package TriTrack
 * @author franzxml
 */

class TimerManager {
    constructor() {
        this.timers = {};
        this.targetHours = 2;
        this.initializeTimers();
        this.attachEventListeners();
        this.loadSavedTimers();
    }
    
    initializeTimers() {
        const cards = document.querySelectorAll('.timer-card');
        cards.forEach(card => {
            const activity = card.dataset.activity;
            this.timers[activity] = { seconds: 0, interval: null, isRunning: false };
        });
    }
    
    attachEventListeners() {
        const cards = document.querySelectorAll('.timer-card');
        cards.forEach(card => {
            const activity = card.dataset.activity;
            card.querySelector('.btn-start').addEventListener('click', () => this.startTimer(activity, card));
            card.querySelector('.btn-pause').addEventListener('click', () => this.pauseTimer(activity, card));
            card.querySelector('.btn-stop').addEventListener('click', () => this.stopTimer(activity, card));
        });
    }
    
    startTimer(activity, card) {
        if (this.timers[activity].isRunning) return;
        this.timers[activity].isRunning = true;
        this.updateButtonStates(card, 'running');
        this.timers[activity].interval = setInterval(() => {
            this.timers[activity].seconds++;
            this.updateDisplay(activity, card);
            this.saveTimerState(activity);
        }, 1000);
    }
    
    pauseTimer(activity, card) {
        this.timers[activity].isRunning = false;
        clearInterval(this.timers[activity].interval);
        this.updateButtonStates(card, 'paused');
        this.saveTimerState(activity);
    }
}

document.addEventListener('DOMContentLoaded', () => { new TimerManager(); });