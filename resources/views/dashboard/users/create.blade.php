<x-dashboard-layout pageTitle="Tambah Pengguna" :breadcrumbs="[['label' => 'Pengguna', 'href' => '/dashboard/users'], ['label' => 'Tambah']]">
    <form method="POST" action="/dashboard/users">@csrf @include('dashboard.users._form', ['user' => null])</form>
</x-dashboard-layout>
