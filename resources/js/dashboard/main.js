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
let imageIndex = 0;
function addImageRow() {
    const container = document.getElementById('imageRepeater');
    if (!container) return;
    if (imageIndex === 0) imageIndex = parseInt(container.dataset.count || 0);
    
    const row = document.createElement('div');
    row.className = 'flex items-center gap-3 p-4 bg-slate-50 rounded-xl border border-slate-200 image-row';
    row.innerHTML = `
        <input type="text" name="images[${imageIndex}][image_path]" placeholder="Path / URL gambar"
            class="flex-1 px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition" />
        <input type="number" name="images[${imageIndex}][order]" value="0" min="0" onkeydown="if(event.key === '-') event.preventDefault()" placeholder="Urutan"
            class="w-20 px-3 py-2.5 border border-slate-200 rounded-xl text-sm text-center focus:outline-none focus:ring-2 focus:ring-primary/20" />
        <label class="flex items-center gap-1.5 text-xs text-slate-500 shrink-0">
            <input type="checkbox" name="images[${imageIndex}][is_primary]" value="1"
                class="rounded border-slate-300 text-primary focus:ring-primary" />
            Utama
        </label>
        <button type="button" onclick="this.closest('.image-row').remove()"
            class="p-2 text-slate-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition shrink-0">✕</button>
    `;
    container.appendChild(row);
    imageIndex++;
}
window.addImageRow = addImageRow;




