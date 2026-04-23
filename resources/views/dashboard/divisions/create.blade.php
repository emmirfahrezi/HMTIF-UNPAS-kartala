<x-dashboard-layout pageTitle="Tambah Divisi" :breadcrumbs="[['label' => 'Divisi', 'href' => '/dashboard/divisions'], ['label' => 'Tambah']]">
    <form method="POST" action="/dashboard/divisions">@csrf @include('dashboard.divisions._form', ['division' => null])</form>
</x-dashboard-layout>
