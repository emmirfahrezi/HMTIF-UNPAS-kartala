<x-layouts.dashboard pageTitle="Tambah Arsip" :breadcrumbs="[['label' => 'Pengarsipan', 'href' => '/dashboard/archives'], ['label' => 'Tambah']]">
    <form method="POST" action="/dashboard/archives" enctype="multipart/form-data">
        @csrf
        @include('dashboard.archives._form', ['archive' => null])

        <div class="mt-12 flex items-center justify-end gap-3">
            <x-atoms.shared.button variant="ghost" href="/dashboard/archives">
                Batal
            </x-atoms.shared.button>
            <x-atoms.shared.button type="submit">
                Tambah Arsip
            </x-atoms.shared.button>
        </div>
    </form>
</x-layouts.dashboard>
