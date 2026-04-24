<x-layouts.dashboard pageTitle="Tambah Divisi" :breadcrumbs="[['label' => 'Pengurus', 'href' => '/dashboard/staffs'], ['label' => 'Tambah Divisi']]">
    <form method="POST" action="/dashboard/staffs/divisions">@csrf @include('dashboard.staffs.divisions._form', ['division' => null])</form>
</x-layouts.dashboard>
