/**
 * Confirmation Modal Helper
 */
function openDeleteModal(action, message) {
    const modal = document.getElementById('deleteModal');
    const form = document.getElementById('deleteForm');
    const msg = document.getElementById('deleteModalMessage');
    
    if (modal && form && msg) {
        form.action = action;
        if (message) msg.textContent = message;
        modal.style.display = 'flex';
    }
}

function closeDeleteModal() {
    const modal = document.getElementById('deleteModal');
    if (modal) {
        modal.style.display = 'none';
    }
}

// Close modal on escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeDeleteModal();
});

// Export to window
window.openDeleteModal = openDeleteModal;
window.closeDeleteModal = closeDeleteModal;
