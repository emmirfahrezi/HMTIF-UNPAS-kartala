/**
 * Minute Form Helpers
 */
let attIndex = parseInt(document.getElementById('attendeeRepeater')?.dataset.count || 0);

function addAttendeeRow() {
    const c = document.getElementById('attendeeRepeater');
    if (!c) return;
    
    const d = document.createElement('div');
    d.className = 'p-4 bg-slate-50 rounded-xl border border-slate-200 attendee-row';
    d.innerHTML = `<div class="grid grid-cols-2 md:grid-cols-5 gap-3">
        <input type="text" name="attendees[${attIndex}][name]" placeholder="Nama" class="px-3 py-2 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/20" />
        <input type="text" name="attendees[${attIndex}][nim]" placeholder="NIM" class="px-3 py-2 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/20" />
        <input type="text" name="attendees[${attIndex}][jabatan]" placeholder="Jabatan" class="px-3 py-2 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/20" />
        <select name="attendees[${attIndex}][keterangan]" class="px-3 py-2 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 bg-white">
            <option value="hadir">Hadir</option><option value="izin">Izin</option><option value="alpha">Alpha</option>
        </select>
        <div class="flex items-center gap-2">
            <input type="number" name="attendees[${attIndex}][order]" value="0" placeholder="#" class="w-16 px-2 py-2 border border-slate-200 rounded-lg text-sm text-center focus:outline-none focus:ring-2 focus:ring-primary/20" />
            <button type="button" onclick="this.closest('.attendee-row').remove()" class="p-2 text-slate-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition">✕</button>
        </div>
    </div>`;
    c.appendChild(d);
    attIndex++;
}

window.addAttendeeRow = addAttendeeRow;
