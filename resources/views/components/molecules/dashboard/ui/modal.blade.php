@props([
    'id',
    'title' => 'Modal Title',
])

<div id="{{ $id }}" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    {{-- Overlay --}}
    <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" onclick="toggleModal('{{ $id }}')"></div>

    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
        <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
            {{-- Header --}}
            <div class="bg-white px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                <h3 class="text-base font-bold text-slate-800" id="modal-title">{{ $title }}</h3>
                <button type="button" class="text-slate-400 hover:text-slate-600 transition" onclick="toggleModal('{{ $id }}')">
                    <x-heroicon-o-x-mark class="size-5" />
                </button>
            </div>

            {{-- Content --}}
            <div class="bg-white px-6 py-6">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>

<script>
    if (typeof window.toggleModal === 'undefined') {
        window.toggleModal = function(id) {
            const modal = document.getElementById(id);
            if (modal) {
                modal.classList.toggle('hidden');
                if (!modal.classList.contains('hidden')) {
                    document.body.style.overflow = 'hidden';
                } else {
                    document.body.style.overflow = 'auto';
                }
            }
        }
    }
</script>
