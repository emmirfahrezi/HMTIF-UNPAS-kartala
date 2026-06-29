<x-layouts.dashboard pageTitle="Tambah Kegiatan" :breadcrumbs="[['label' => 'Kegiatan', 'href' => '/dashboard/activities'], ['label' => 'Tambah']]">
    <form method="POST" action="/dashboard/activities" enctype="multipart/form-data">
        @csrf
        @include('dashboard.activities._form', ['activity' => null])
        
        <div class="mt-12 flex items-center justify-end gap-3">
            <x-atoms.shared.button 
                variant="ghost"
                href="/dashboard/activities">
                Batal
            </x-atoms.shared.button>
            <x-atoms.shared.button 
                type="submit">
                Tambah Kegiatan
            </x-atoms.shared.button>
        </div>
    </form>
</x-layouts.dashboard>
