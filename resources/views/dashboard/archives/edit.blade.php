<x-layouts.dashboard pageTitle="Edit Arsip" :breadcrumbs="[['label' => 'Pengarsipan', 'href' => '/dashboard/archives'], ['label' => 'Edit']]">
    <form method="POST" action="/dashboard/archives/{{ data_get($archive, 'id') }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('dashboard.archives._form', ['archive' => $archive])

        <div class="mt-12 flex items-center justify-end gap-3">
            <x-atoms.shared.button variant="ghost" href="/dashboard/archives">
                Batal
            </x-atoms.shared.button>
            <x-atoms.shared.button type="submit">
                Simpan Perubahan
            </x-atoms.shared.button>
        </div>
    </form>
</x-layouts.dashboard>
