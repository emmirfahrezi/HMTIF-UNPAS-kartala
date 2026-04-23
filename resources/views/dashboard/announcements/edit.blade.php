<x-dashboard-layout pageTitle="Edit Pengumuman" :breadcrumbs="[['label' => 'Pengumuman', 'href' => '/dashboard/announcements'], ['label' => 'Edit']]">
    <form method="POST" action="/dashboard/announcements/{{ $announcement->id }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('dashboard.announcements._form', ['announcement' => $announcement])
    </form>
</x-dashboard-layout>
