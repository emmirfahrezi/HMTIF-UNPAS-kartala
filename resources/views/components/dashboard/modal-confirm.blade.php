{{-- Delete Confirmation Modal --}}
<div id="deleteModal" class="fixed inset-0 z-50 flex items-center justify-center p-4" style="display: none;">
    {{-- Backdrop --}}
    <div class="absolute inset-0 bg-black/30" onclick="closeDeleteModal()"></div>

    {{-- Modal --}}
    <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-md p-6 transform transition-all">
        <div class="flex items-start gap-4">
            <div class="w-11 h-11 rounded-full bg-red-100 flex items-center justify-center shrink-0">
                <x-heroicon-o-exclamation-triangle class="size-5 text-red-600" />
            </div>
            <div class="flex-1">
                <h3 class="text-base font-bold text-slate-800">Konfirmasi Hapus</h3>
                <p class="text-sm text-slate-500 mt-1" id="deleteModalMessage">
                    Apakah kamu yakin ingin menghapus item ini? Tindakan ini tidak bisa dibatalkan.
                </p>
            </div>
        </div>

        <div class="flex items-center justify-end gap-3 mt-6">
            <button onclick="closeDeleteModal()"
                class="px-5 py-2.5 text-sm font-semibold text-slate-600 bg-slate-100 rounded-xl hover:bg-slate-200 transition">
                Batal
            </button>
            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="px-5 py-2.5 text-sm font-semibold text-white bg-red-600 rounded-xl hover:bg-red-700 shadow-lg shadow-red-500/20 transition active:scale-95">
                    Hapus
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    function openDeleteModal(action, message) {
        const modal = document.getElementById('deleteModal');
        const form = document.getElementById('deleteForm');
        const msg = document.getElementById('deleteModalMessage');
        form.action = action;
        if (message) msg.textContent = message;
        modal.style.display = 'flex';
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').style.display = 'none';
    }

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeDeleteModal();
    });
</script>
