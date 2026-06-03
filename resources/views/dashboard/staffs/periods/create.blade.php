<x-layouts.dashboard pageTitle="Tambah Periode" :breadcrumbs="[['label' => 'Pengurus', 'href' => '/dashboard/staffs'], ['label' => 'Periode', 'href' => '/dashboard/staffs/periods'], ['label' => 'Tambah']]">
    <form method="POST" action="/dashboard/staffs/periods">
        @csrf
        @include('dashboard.staffs.periods._form', ['period' => null])

        <div class="mt-12 flex items-center justify-end gap-3">
            <x-atoms.shared.button
                variant="ghost"
                href="/dashboard/staffs/periods">
                Batal
            </x-atoms.shared.button>
            <x-atoms.shared.button
                type="submit">
                Tambah Periode
            </x-atoms.shared.button>
        </div>
    </form>
</x-layouts.dashboard>
