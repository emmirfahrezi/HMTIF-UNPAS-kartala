<x-layouts.dashboard pageTitle="Edit Pengumuman" :breadcrumbs="[['label' => 'Pengumuman', 'href' => '/dashboard/announcements'], ['label' => 'Edit']]">
    <form method="POST" action="/dashboard/announcements/{{ $announcement->id }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('dashboard.announcements._form', ['announcement' => $announcement])
        
        <div class="mt-12 flex items-center justify-end gap-3">
            <x-atoms.shared.button 
                variant="ghost"
                href="/dashboard/announcements">
                Batal
            </x-atoms.shared.button>
            <x-atoms.shared.button 
                type="submit">
                Simpan Perubahan
            </x-atoms.shared.button>
        </div>
    </form>
</x-layouts.dashboard>
