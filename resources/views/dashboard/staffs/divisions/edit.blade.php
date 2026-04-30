<x-layouts.dashboard pageTitle="Edit Divisi" :breadcrumbs="[['label' => 'Pengurus', 'href' => '/dashboard/staffs'], ['label' => 'Divisi', 'href' => '/dashboard/staffs/divisions'], ['label' => 'Edit']]">
    <form method="POST" action="/dashboard/staffs/divisions/{{ $division->id }}">
        @csrf
        @method('PUT')
        @include('dashboard.staffs.divisions._form', ['division' => $division])
        
        <div class="mt-12 flex items-center justify-end gap-3">
            <x-atoms.shared.button 
                variant="ghost"
                href="/dashboard/staffs/divisions">
                Batal
            </x-atoms.shared.button>
            <x-atoms.shared.button 
                type="submit">
                Simpan Perubahan
            </x-atoms.shared.button>
        </div>
    </form>
</x-layouts.dashboard>
