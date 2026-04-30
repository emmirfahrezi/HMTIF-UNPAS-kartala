<x-layouts.dashboard pageTitle="Tambah Pengurus" :breadcrumbs="[['label' => 'Pengurus', 'href' => '/dashboard/staffs'], ['label' => 'Tambah']]">
    <form method="POST" action="/dashboard/staffs">
        @csrf
        @include('dashboard.staffs._form', ['staff' => null])
        
        <div class="mt-12 flex items-center justify-end gap-3">
            <x-atoms.shared.button 
                variant="ghost"
                href="/dashboard/staffs">
                Batal
            </x-atoms.shared.button>
            <x-atoms.shared.button 
                type="submit">
                Tambah Pengurus
            </x-atoms.shared.button>
        </div>
    </form>
</x-layouts.dashboard>
