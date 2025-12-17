/**
 * Modal Component
 * Handle modal dialogs
 * 
 * @package TriTrack
 * @author franzxml
 */

class ModalManager {
    /**
     * Initialize modal manager
     */
    constructor() {
        this.overlay = null;
        this.currentCallback = null;
    }
    
    /**
     * Show notes modal
     * 
     * @param {string} activity Activity name
     * @param {Function} callback Callback function
     */
    showNotesModal(activity, callback) {
        this.currentCallback = callback;
        this.createModal(activity);
    }
    
    /**
     * Create modal HTML
     * 
     * @param {string} activity Activity name
     */
    createModal(activity) {
        this.overlay = document.createElement('div');
        this.overlay.className = 'modal-overlay';
        this.overlay.innerHTML = `
            <div class="modal-container">
                <div class="modal-header">
                    <h3 class="modal-title">Add Session Notes</h3>
                    <button class="modal-close" onclick="window.modalManager.closeModal()">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label">Activity</label>
                        <input type="text" class="form-input" value="${activity}" readonly>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Session Notes</label>
                        <textarea class="form-textarea" id="sessionNotes" 
                            placeholder="What did you accomplish in this session?"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn-modal btn-cancel" onclick="window.modalManager.closeModal()">Cancel</button>
                    <button class="btn-modal btn-save" onclick="window.modalManager.saveNotes()">Save</button>
                </div>
            </div>
        `;
        document.body.appendChild(this.overlay);
        setTimeout(() => this.overlay.classList.add('active'), 10);
    }
    
    /**
     * Close modal
     */
    closeModal() {
        if (this.overlay) {
            this.overlay.classList.remove('active');
            setTimeout(() => {
                document.body.removeChild(this.overlay);
                this.overlay = null;
                this.currentCallback = null;
            }, 300);
        }
    }
    
    /**
     * Save notes and trigger callback
     */
    saveNotes() {
        const notes = document.getElementById('sessionNotes').value.trim();
        if (this.currentCallback) {
            this.currentCallback(notes);
        }
        this.closeModal();
    }
}

// Initialize global modal manager
window.modalManager = new ModalManager();