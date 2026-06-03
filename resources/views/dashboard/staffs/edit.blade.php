<x-layouts.dashboard pageTitle="Edit Pengurus" :breadcrumbs="[['label' => 'Pengurus', 'href' => '/dashboard/staffs'], ['label' => 'Edit']]">
    <form method="POST" action="/dashboard/staffs/{{ $staff->id }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('dashboard.staffs._form', ['staff' => $staff])
        
        <div class="mt-12 flex items-center justify-end gap-3">
            <x-atoms.shared.button 
                variant="ghost"
                href="/dashboard/staffs">
                Batal
            </x-atoms.shared.button>
            <x-atoms.shared.button 
                type="submit">
                Simpan Perubahan
            </x-atoms.shared.button>
        </div>
    </form>
</x-layouts.dashboard>
