<x-layouts.dashboard pageTitle="Tambah Pengumuman" :breadcrumbs="[['label' => 'Pengumuman', 'href' => '/dashboard/announcements'], ['label' => 'Tambah']]">
    <form method="POST" action="/dashboard/announcements" enctype="multipart/form-data">
        @csrf
        @include('dashboard.announcements._form', ['announcement' => null])
        
        <div class="mt-12 flex items-center justify-end gap-3">
            <x-atoms.shared.button 
                variant="ghost"
                href="/dashboard/announcements">
                Batal
            </x-atoms.shared.button>
            <x-atoms.shared.button 
                type="submit">
                Tambah Pengumuman
            </x-atoms.shared.button>
        </div>
    </form>
</x-layouts.dashboard>
