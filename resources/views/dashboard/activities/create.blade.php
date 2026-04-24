<x-layouts.dashboard pageTitle="Tambah Kegiatan" :breadcrumbs="[['label' => 'Kegiatan', 'href' => '/dashboard/activities'], ['label' => 'Tambah']]">
    <form method="POST" action="/dashboard/activities" enctype="multipart/form-data">
        @csrf
        @include('dashboard.activities._form', ['activity' => null])
    </form>
</x-layouts.dashboard>
