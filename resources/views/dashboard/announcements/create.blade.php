<x-layouts.dashboard pageTitle="Tambah Pengumuman" :breadcrumbs="[['label' => 'Pengumuman', 'href' => '/dashboard/announcements'], ['label' => 'Tambah']]">
    <form method="POST" action="/dashboard/announcements" enctype="multipart/form-data">
        @csrf
        @include('dashboard.announcements._form', ['announcement' => null])
    </form>
</x-layouts.dashboard>
