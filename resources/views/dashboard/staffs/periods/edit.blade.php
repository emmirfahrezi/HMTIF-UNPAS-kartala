<x-layouts.dashboard pageTitle="Edit Periode" :breadcrumbs="[['label' => 'Pengurus', 'href' => '/dashboard/staffs'], ['label' => 'Periode', 'href' => '/dashboard/staffs/periods'], ['label' => 'Edit']]">
    <form method="POST" action="/dashboard/staffs/periods/{{ $period->id }}">
        @csrf
        @method('PUT')
        @include('dashboard.staffs.periods._form', ['period' => $period])

        <div class="mt-12 flex items-center justify-end gap-3">
            <x-atoms.shared.button
                variant="ghost"
                href="/dashboard/staffs/periods">
                Batal
            </x-atoms.shared.button>
            <x-atoms.shared.button
                type="submit">
                Simpan Perubahan
            </x-atoms.shared.button>
        </div>
    </form>
</x-layouts.dashboard>
