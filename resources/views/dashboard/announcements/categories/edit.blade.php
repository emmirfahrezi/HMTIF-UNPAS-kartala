<x-layouts.dashboard pageTitle="Edit Kategori Pengumuman" :breadcrumbs="[['label' => 'Pengumuman', 'href' => '/dashboard/announcements'], ['label' => 'Kategori', 'href' => '/dashboard/announcements/categories'], ['label' => 'Edit']]">
    <form method="POST" action="/dashboard/announcements/categories/{{ $category->id }}">
        @csrf
        @method('PUT')
        @include('dashboard.announcements.categories._form', ['category' => $category])
        
        <div class="mt-12 flex items-center justify-end gap-3">
            <x-atoms.shared.button 
                variant="ghost"
                href="/dashboard/announcements/categories">
                Batal
            </x-atoms.shared.button>
            <x-atoms.shared.button 
                type="submit">
                Simpan Perubahan
            </x-atoms.shared.button>
        </div>
    </form>
</x-layouts.dashboard>
