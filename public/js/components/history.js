/**
 * History Component
 * Display weekly activity history
 * 
 * @package TriTrack
 * @author franzxml
 */

class HistoryManager {
    /**
     * Initialize history manager
     */
    constructor() {
        this.currentWeekOffset = 0;
        this.attachEventListeners();
        this.loadWeekData();
    }
    
    /**
     * Attach event listeners
     */
    attachEventListeners() {
        document.getElementById('prevWeek').addEventListener('click', () => {
            this.currentWeekOffset--;
            this.loadWeekData();
        });
        
        document.getElementById('nextWeek').addEventListener('click', () => {
            if (this.currentWeekOffset < 0) {
                this.currentWeekOffset++;
                this.loadWeekData();
            }
        });
    }
    
    /**
     * Load week data
     */
    async loadWeekData() {
        const response = await ApiHelper.getWeeklySummary(this.currentWeekOffset);
        
        if (response.success) {
            this.displayWeekRange();
            this.displaySummaryStats(response.data);
        }
    }
    
    /**
     * Display week range
     */
    displayWeekRange() {
        const today = new Date();
        const offset = this.currentWeekOffset * 7;
        const weekStart = new Date(today.setDate(today.getDate() - today.getDay() + 1 + offset));
        const weekEnd = new Date(weekStart);
        weekEnd.setDate(weekStart.getDate() + 6);
        
        const formatDate = (date) => {
            return date.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });
        };
        
        document.getElementById('weekDisplay').textContent = 
            `${formatDate(weekStart)} - ${formatDate(weekEnd)}`;
    }
    
    /**
     * Display summary statistics
     * 
     * @param {Array} data Summary data
     */
    displaySummaryStats(data) {
        const statsContainer = document.getElementById('weeklySummaryStats');
        statsContainer.innerHTML = '';
        
        let totalSeconds = 0;
        let totalDays = 0;
        
        data.forEach(summary => {
            totalSeconds += parseInt(summary.total_seconds);
            if (summary.total_seconds > 0) totalDays++;
        });
        
        const avgSeconds = totalDays > 0 ? Math.floor(totalSeconds / totalDays) : 0;
        
        const stats = [
            { label: 'Total Time', value: TimerHelper.formatTime(totalSeconds) },
            { label: 'Active Days', value: totalDays },
            { label: 'Daily Average', value: TimerHelper.formatTime(avgSeconds) }
        ];
        
        stats.forEach(stat => {
            const card = document.createElement('div');
            card.className = 'stat-card';
            card.innerHTML = `
                <div class="stat-label">${stat.label}</div>
                <div class="stat-value">${stat.value}</div>
            `;
            statsContainer.appendChild(card);
        });
    }
}

document.addEventListener('DOMContentLoaded', () => { new HistoryManager(); });