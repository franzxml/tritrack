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
    
    stopTimer(activity, card) {
        this.timers[activity].isRunning = false;
        clearInterval(this.timers[activity].interval);
        this.timers[activity].seconds = 0;
        this.updateDisplay(activity, card);
        this.updateButtonStates(card, 'stopped');
        StorageHelper.clearTimer(activity);
    }
    
    updateDisplay(activity, card) {
        const display = card.querySelector('.timer-display');
        const progressFill = card.querySelector('.progress-fill');
        display.textContent = TimerHelper.formatTime(this.timers[activity].seconds);
        const targetSeconds = this.targetHours * 3600;
        const progress = TimerHelper.calculateProgress(this.timers[activity].seconds, targetSeconds);
        progressFill.style.width = `${progress}%`;
    }
    
    updateButtonStates(card, state) {
        const btnStart = card.querySelector('.btn-start');
        const btnPause = card.querySelector('.btn-pause');
        const btnStop = card.querySelector('.btn-stop');
        if (state === 'running') {
            btnStart.disabled = true;
            btnPause.disabled = false;
            btnStop.disabled = false;
        } else if (state === 'paused') {
            btnStart.disabled = false;
            btnPause.disabled = true;
            btnStop.disabled = false;
        } else {
            btnStart.disabled = false;
            btnPause.disabled = true;
            btnStop.disabled = true;
        }
    }
    
    saveTimerState(activity) {
        const data = { seconds: this.timers[activity].seconds, date: StorageHelper.getTodayKey() };
        StorageHelper.saveTimer(activity, data);
    }
    
    loadSavedTimers() {
        const cards = document.querySelectorAll('.timer-card');
        const today = StorageHelper.getTodayKey();
        cards.forEach(card => {
            const activity = card.dataset.activity;
            const saved = StorageHelper.loadTimer(activity);
            if (saved && saved.date === today) {
                this.timers[activity].seconds = saved.seconds;
                this.updateDisplay(activity, card);
            }
        });
    }
}

document.addEventListener('DOMContentLoaded', () => { new TimerManager(); });