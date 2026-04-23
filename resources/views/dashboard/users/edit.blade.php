<x-dashboard-layout pageTitle="Edit Pengguna" :breadcrumbs="[['label' => 'Pengguna', 'href' => '/dashboard/users'], ['label' => 'Edit']]">
    <form method="POST" action="/dashboard/users/{{ $user->id }}">@csrf @method('PUT') @include('dashboard.users._form', ['user' => $user])</form>
</x-dashboard-layout>
