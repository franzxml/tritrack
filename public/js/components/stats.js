/**
 * Statistics Component
 * Display and manage statistics data
 * 
 * @package TriTrack
 * @author franzxml
 */

class StatsManager {
    /**
     * Initialize statistics manager
     */
    constructor() {
        this.loadTodayStats();
    }
    
    /**
     * Load today's statistics
     */
    async loadTodayStats() {
        const response = await ApiHelper.getTodaySessions();
        
        if (response.success) {
            this.displaySummary(response.data);
            this.displayBreakdown(response.data);
            this.displaySessions(response.data);
        }
    }
    
    /**
     * Display summary statistics
     * 
     * @param {Array} sessions Session data
     */
    displaySummary(sessions) {
        let totalSeconds = 0;
        const activityTotals = {};
        
        sessions.forEach(session => {
            totalSeconds += parseInt(session.duration_seconds);
            const activity = session.display_name;
            activityTotals[activity] = (activityTotals[activity] || 0) + parseInt(session.duration_seconds);
        });
        
        document.getElementById('totalTime').textContent = TimerHelper.formatTime(totalSeconds);
        document.getElementById('sessionCount').textContent = sessions.length;
        
        const mostActive = Object.keys(activityTotals).reduce((a, b) => 
            activityTotals[a] > activityTotals[b] ? a : b, '-'
        );
        document.getElementById('mostActive').textContent = mostActive;
    }
    
    /**
     * Display activity breakdown
     * 
     * @param {Array} sessions Session data
     */
    displayBreakdown(sessions) {
        const activityTotals = {};
        
        sessions.forEach(session => {
            const activity = session.display_name;
            activityTotals[activity] = (activityTotals[activity] || 0) + parseInt(session.duration_seconds);
        });
        
        const breakdownList = document.getElementById('breakdownList');
        breakdownList.innerHTML = '';
        
        Object.entries(activityTotals).forEach(([activity, seconds]) => {
            const item = document.createElement('div');
            item.className = 'breakdown-item';
            item.innerHTML = `
                <span class="breakdown-name">${activity}</span>
                <span class="breakdown-time">${TimerHelper.formatTime(seconds)}</span>
            `;
            breakdownList.appendChild(item);
        });
    }
    
    /**
     * Display sessions list
     * 
     * @param {Array} sessions Session data
     */
    displaySessions(sessions) {
        const sessionsList = document.getElementById('sessionsList');
        sessionsList.innerHTML = '';
        
        if (sessions.length === 0) {
            sessionsList.innerHTML = '<p style="text-align: center; color: #666;">No sessions today</p>';
            return;
        }
        
        sessions.forEach(session => {
            const item = document.createElement('div');
            item.className = 'session-item';
            const startTime = new Date(session.start_time).toLocaleTimeString('en-US', { 
                hour: '2-digit', minute: '2-digit' 
            });
            item.innerHTML = `
                <div class="session-info">
                    <div class="session-activity">${session.display_name}</div>
                    <div class="session-time">Started at ${startTime}</div>
                </div>
                <div class="session-duration">${TimerHelper.formatTime(session.duration_seconds)}</div>
            `;
            sessionsList.appendChild(item);
        });
    }
}

document.addEventListener('DOMContentLoaded', () => { new StatsManager(); });