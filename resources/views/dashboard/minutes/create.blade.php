<x-layouts.dashboard pageTitle="Tambah Notulensi" :breadcrumbs="[['label' => 'Notulensi', 'href' => '/dashboard/minutes'], ['label' => 'Tambah']]">
    <form action="/dashboard/minutes" method="POST" enctype="multipart/form-data">
        @csrf

        @include('dashboard.minutes._form')

        <div class="mt-12 flex items-center justify-end gap-3">
            <x-atoms.shared.button 
                variant="ghost"
                href="/dashboard/minutes">
                Batal
            </x-atoms.shared.button>
            <x-atoms.shared.button 
                type="submit">
                Selesaikan & Simpan
            </x-atoms.shared.button>
        </div>
    </form>
</x-layouts.dashboard>