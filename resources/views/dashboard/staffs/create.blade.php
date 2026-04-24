<x-layouts.dashboard pageTitle="Tambah Pengurus" :breadcrumbs="[['label' => 'Pengurus', 'href' => '/dashboard/staffs'], ['label' => 'Tambah']]">
    <form method="POST" action="/dashboard/staffs">
        @csrf
        @include('dashboard.staffs._form', ['staff' => null])
    </form>
</x-layouts.dashboard>
