<x-layouts.dashboard pageTitle="Edit Notulensi" :breadcrumbs="[['label' => 'Notulensi', 'href' => '/dashboard/minutes'], ['label' => 'Edit']]">
    <form action="/dashboard/minutes/{{ $minute->id }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @include('dashboard.minutes._form', ['minute' => $minute])

        <div class="mt-12 flex items-center justify-end gap-3">
            <x-atoms.shared.button 
                variant="ghost"
                href="/dashboard/minutes">
                Batal
            </x-atoms.shared.button>
            <x-atoms.shared.button 
                type="submit">
                Simpan Perubahan
            </x-atoms.shared.button>
        </div>
    </form>
</x-layouts.dashboard>