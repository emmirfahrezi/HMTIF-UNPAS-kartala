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

function buildProductImageRow(index) {
    return `
        <div class="flex flex-col gap-4">
            <div class="flex flex-col gap-4 xl:flex-row xl:items-start xl:justify-between">
                <div class="space-y-2">
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300">Sumber Gambar</label>
                    <div class="inline-grid grid-cols-2 overflow-hidden rounded-2xl border border-slate-200/50 dark:border-slate-800/70 bg-slate-100 dark:bg-slate-950/60 p-1">
                        <button type="button" @click="source = 'url'" :class="source === 'url' ? 'bg-white dark:bg-slate-800 text-primary shadow-sm' : 'text-slate-500 dark:text-slate-400'" class="rounded-xl px-5 py-2 text-xs font-bold transition">URL</button>
                        <button type="button" @click="source = 'file'" :class="source === 'file' ? 'bg-white dark:bg-slate-800 text-primary shadow-sm' : 'text-slate-500 dark:text-slate-400'" class="rounded-xl px-5 py-2 text-xs font-bold transition">File</button>
                    </div>
                </div>

                <div class="flex flex-wrap items-end gap-4 xl:justify-end">
                    <div class="space-y-1.5 w-28">
                        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5 transition-colors duration-300">Urutan Tampil</label>
                        <input type="number" name="images[${index}][order]" value="0" min="0" onkeydown="if(event.key === '-') event.preventDefault()"
                            class="w-full px-4 py-3 border border-slate-200/50 dark:border-slate-800/50 bg-white dark:bg-slate-950/45 rounded-2xl text-sm text-slate-700 dark:text-white placeholder:text-slate-400 dark:placeholder:text-slate-600 focus:outline-none focus:ring-4 focus:ring-primary/10 focus:border-primary transition-all duration-300 shadow-sm">
                    </div>

                    <label class="inline-flex items-center gap-2.5 cursor-pointer group/cb pb-3">
                        <div class="relative flex items-center justify-center">
                            <input type="checkbox" name="images[${index}][is_primary]" value="1"
                                class="peer appearance-none size-5 rounded-lg border-2 border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-950 checked:bg-primary checked:border-primary transition-all duration-300 focus:outline-none focus:ring-4 focus:ring-primary/10" />
                            <svg class="absolute size-3 text-white scale-50 opacity-0 peer-checked:scale-100 peer-checked:opacity-100 transition-all duration-300 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <span class="text-sm font-semibold text-slate-600 dark:text-slate-400 group-hover/cb:text-slate-900 dark:group-hover/cb:text-slate-200 transition-colors duration-300">Utama</span>
                    </label>

                    <button type="button" onclick="this.closest('.image-row').remove()"
                        class="mb-2 size-9 flex items-center justify-center text-red-500 hover:bg-red-50 dark:hover:bg-red-500/10 rounded-xl transition shadow-sm bg-white dark:bg-slate-950/45 border border-slate-200/50 dark:border-slate-800/50 active:scale-95 group/btn">
                        <svg class="size-4 transition-transform group-hover/btn:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                    </button>
                </div>
            </div>

            <div x-show="source === 'url'" x-cloak class="space-y-1.5">
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5 transition-colors duration-300">URL / Path Gambar</label>
                <input type="text" name="images[${index}][image_path]" placeholder="https://..."
                    class="w-full px-4 py-3 border border-slate-200/50 dark:border-slate-800/50 bg-white dark:bg-slate-950/45 rounded-2xl text-sm text-slate-700 dark:text-white placeholder:text-slate-400 dark:placeholder:text-slate-600 focus:outline-none focus:ring-4 focus:ring-primary/10 focus:border-primary transition-all duration-300 shadow-sm">
            </div>

            <div x-show="source === 'file'" x-cloak class="space-y-2">
                <label class="block text-sm font-bold text-slate-700 dark:text-slate-300">File Lokal</label>
                <input type="file" accept="image/*"
                    class="w-full rounded-2xl border border-slate-200/50 dark:border-slate-800/70 bg-white dark:bg-slate-950/45 px-4 py-3 text-sm text-slate-500 dark:text-slate-400 file:mr-3 file:rounded-xl file:border-0 file:bg-primary/10 file:px-4 file:py-2 file:text-xs file:font-black file:uppercase file:text-primary hover:file:bg-primary/20 transition">
            </div>
        </div>
    `;
}

function addImageRow() {
    const container = document.getElementById('imageRepeater');
    if (!container) return;
    if (imageIndex === 0) imageIndex = parseInt(container.dataset.count || 0);

    const row = document.createElement('div');
    row.className = 'image-row rounded-2xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-950/40 p-4 shadow-sm transition hover:border-primary/20 dark:hover:border-primary/30 animate-in fade-in slide-in-from-top-2 duration-300';
    row.setAttribute('x-data', "{ source: 'url' }");
    row.innerHTML = buildProductImageRow(imageIndex);

    container.appendChild(row);
    imageIndex++;
    container.dataset.count = imageIndex;
    window.Alpine?.initTree(row);
}

window.addImageRow = addImageRow;
