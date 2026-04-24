/**
 * Dashboard Sidebar Toggle
 */
function toggleSidebar() {
    const sidebar = document.getElementById('dashSidebar');
    const overlay = document.getElementById('sidebarOverlay');
    
    if (sidebar && overlay) {
        sidebar.classList.toggle('open');
        overlay.classList.toggle('open');
    }
}

// Export to window object for onclick events
window.toggleSidebar = toggleSidebar;
