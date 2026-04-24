/**
 * Flash Message Auto-hide
 */
document.addEventListener('DOMContentLoaded', function() {
    const flashEl = document.getElementById('flashMessage');
    if (flashEl) {
        setTimeout(function() {
            flashEl.style.opacity = '0';
            setTimeout(function() { flashEl.remove(); }, 500);
        }, 5000);
    }
});
