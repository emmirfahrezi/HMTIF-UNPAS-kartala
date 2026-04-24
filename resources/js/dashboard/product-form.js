/**
 * Product Form Helpers
 */
let imageIndex = parseInt(document.getElementById('imageRepeater')?.dataset.count || 0);

function addImageRow() {
    const container = document.getElementById('imageRepeater');
    if (!container) return;
    
    const row = document.createElement('div');
    row.className = 'flex items-center gap-3 p-4 bg-slate-50 rounded-xl border border-slate-200 image-row';
    row.innerHTML = `
        <input type="text" name="images[${imageIndex}][image_path]" placeholder="Path / URL gambar"
            class="flex-1 px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition" />
        <input type="number" name="images[${imageIndex}][order]" value="0" placeholder="Urutan"
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
