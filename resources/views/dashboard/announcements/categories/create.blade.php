<x-layouts.dashboard pageTitle="Tambah Kategori Pengumuman" :breadcrumbs="[['label' => 'Pengumuman', 'href' => '/dashboard/announcements'], ['label' => 'Kategori', 'href' => '/dashboard/announcements/categories'], ['label' => 'Tambah']]">
    <form method="POST" action="/dashboard/announcements/categories">
        @csrf
        @include('dashboard.announcements.categories._form', ['category' => null])
        
        <div class="mt-12 flex items-center justify-end gap-3">
            <x-atoms.shared.button 
                variant="ghost"
                href="/dashboard/announcements/categories">
                Batal
            </x-atoms.shared.button>
            <x-atoms.shared.button 
                type="submit">
                Tambah Kategori
            </x-atoms.shared.button>
        </div>
    </form>
</x-layouts.dashboard>
