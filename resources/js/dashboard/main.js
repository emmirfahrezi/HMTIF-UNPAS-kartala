/**
 * Dashboard Core Scripts
 * Consolidates smaller helpers into one file for cleaner project structure
 */

// 1. Flash Message Auto-hide
document.addEventListener('DOMContentLoaded', function() {
    const flashEl = document.getElementById('flashMessage');
    if (flashEl) {
        setTimeout(function() {
            flashEl.style.opacity = '0';
            setTimeout(function() { flashEl.remove(); }, 500);
        }, 5000);
    }
});

// 3. Product Form Image Repeater
function addImageRow() {
    const container = document.getElementById('imageRepeater');
    const template = document.getElementById('productImageRowTemplate');

    if (!container) return;

    const index = parseInt(container.dataset.count || container.querySelectorAll('.image-row').length || 0, 10);

    if (!template) return;

    container.insertAdjacentHTML('beforeend', template.innerHTML.replaceAll('__INDEX__', index));
    container.dataset.count = index + 1;

    const row = container.lastElementChild;
    window.Alpine?.initTree(row);
}

window.addImageRow = addImageRow;
