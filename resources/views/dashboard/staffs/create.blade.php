<x-layouts.dashboard pageTitle="Tambah Pengurus" :breadcrumbs="[['label' => 'Pengurus', 'href' => '/dashboard/staffs'], ['label' => 'Tambah']]">
    @php($activePeriodLabel = $activePeriod?->label ?? request('period', '2025/2026'))
    <form method="POST" action="/dashboard/staffs" enctype="multipart/form-data">
        @csrf
        @include('dashboard.staffs._form', ['staff' => null])
        
        <div class="mt-12 flex items-center justify-end gap-3">
            <x-atoms.shared.button 
                variant="ghost"
                href="/dashboard/staffs?period={{ urlencode($activePeriodLabel) }}">
                Batal
            </x-atoms.shared.button>
            <x-atoms.shared.button 
                type="submit">
                Tambah Pengurus
            </x-atoms.shared.button>
        </div>
    </form>
</x-layouts.dashboard>
