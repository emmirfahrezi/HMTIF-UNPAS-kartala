<x-layouts.dashboard pageTitle="Tambah Divisi" :breadcrumbs="[['label' => 'Pengurus', 'href' => '/dashboard/staffs'], ['label' => 'Divisi', 'href' => '/dashboard/staffs/divisions'], ['label' => 'Tambah']]">
    <form method="POST" action="/dashboard/staffs/divisions">
        @csrf
        @include('dashboard.staffs.divisions._form', ['division' => null])
        
        <div class="mt-12 flex items-center justify-end gap-3">
            <x-atoms.shared.button 
                variant="ghost"
                href="/dashboard/staffs/divisions">
                Batal
            </x-atoms.shared.button>
            <x-atoms.shared.button 
                type="submit">
                Tambah Divisi
            </x-atoms.shared.button>
        </div>
    </form>
</x-layouts.dashboard>
