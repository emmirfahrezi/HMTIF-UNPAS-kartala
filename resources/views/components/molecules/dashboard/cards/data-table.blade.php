{{-- Data Table with Bulk Selection --}}
@props([
    'headers' => [],
    'bulkDeleteRoute' => '',
    'bulkDeleteEnabled' => false,
    'selectable' => true,
    'showActions' => true,
])

<div 
    x-data="{
        selectedIds: [],
        selectAll: false,
        toggleSelectAll() {
            if (this.selectAll) {
                this.selectedIds = [...document.querySelectorAll('[data-row-id]')].map(el => el.dataset.rowId);
            } else {
                this.selectedIds = [];
            }
        },
        toggleRow(id) {
            const idx = this.selectedIds.indexOf(id);
            if (idx > -1) {
                this.selectedIds.splice(idx, 1);
            } else {
                this.selectedIds.push(id);
            }
            this.selectAll = this.selectedIds.length === document.querySelectorAll('[data-row-id]').length && this.selectedIds.length > 0;
        },
        isSelected(id) {
            return this.selectedIds.includes(id);
        }
    }"
    class="bg-white dark:bg-slate-900/50 border border-slate-200 dark:border-slate-800 rounded-2xl overflow-hidden shadow-sm transition-colors duration-300"
>
    @if (isset($actions))
        <div class="flex items-center justify-end gap-3 p-5 border-b border-slate-100 dark:border-slate-800 bg-slate-50/30 dark:bg-slate-800/30">
            {{ $actions }}
        </div>
    @endif

    {{-- Bulk Action Bar (muncul di atas table, nyatu dengan card) --}}
    <div 
        x-show="{{ $bulkDeleteEnabled ? 'true' : 'false' }} && selectedIds.length > 0"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2"
        x-cloak
        class="flex items-center justify-between gap-4 px-5 py-3 bg-primary/5 dark:bg-primary/10 border-b border-primary/10 dark:border-primary/20"
    >
        <div class="flex items-center gap-3">
            <span class="inline-flex items-center justify-center size-6 rounded-md bg-primary text-white font-bold text-xs" x-text="selectedIds.length"></span>
            <span class="text-sm font-medium text-slate-600 dark:text-slate-400">item dipilih</span>

            <button 
                x-on:click="selectedIds = []; selectAll = false"
                class="text-xs font-semibold text-slate-400 dark:text-slate-500 hover:text-slate-600 dark:hover:text-slate-300 underline underline-offset-2 transition ml-1"
            >Batal pilih</button>
        </div>

        @if($bulkDeleteEnabled && $bulkDeleteRoute)
        <form method="POST" action="{{ $bulkDeleteRoute }}" id="bulkDeleteForm">
            @csrf
            @method('DELETE')
            <template x-for="id in selectedIds" :key="id">
                <input type="hidden" name="ids[]" :value="id" />
            </template>
            <x-atoms.shared.button 
                variant="danger"
                size="sm"
                @click="openBulkDeleteModal('bulkDeleteForm', selectedIds.length)"
                icon="heroicon-o-trash">
                Hapus Terpilih
            </x-atoms.shared.button>
        </form>
        @endif
    </div>

    {{-- Table --}}
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-slate-50/80 dark:bg-slate-800/50 border-b border-slate-100 dark:border-slate-800 transition-colors">
                    {{-- Select All Checkbox --}}
                    @if ($selectable)
                    <th class="px-4 py-4 w-12 text-center">
                        <x-atoms.shared.checkbox 
                            x-model="selectAll"
                            @change="toggleSelectAll()"
                        />
                    </th>
                    @endif
                    @foreach ($headers as $header)
                        <th class="px-5 py-4 text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider whitespace-nowrap {{ $header['class'] ?? '' }}">
                            {{ $header['label'] }}
                        </th>
                    @endforeach
                    @if ($showActions)
                        <th class="px-5 py-4 text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider text-right">Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-800 transition-colors">
                {{ $slot }}
            </tbody>
        </table>
    </div>

    {{-- Empty state fallback --}}
    {{ $empty ?? '' }}

    {{-- Pagination --}}
    @if (isset($pagination))
        <div class="px-5 py-4 border-t border-slate-100 dark:border-slate-800 bg-slate-50/30 dark:bg-slate-800/30">
            {{ $pagination }}
        </div>
    @endif
</div>
