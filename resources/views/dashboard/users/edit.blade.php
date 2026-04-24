<x-layouts.dashboard pageTitle="Edit Pengguna" :breadcrumbs="[['label' => 'Pengguna', 'href' => '/dashboard/users'], ['label' => 'Edit']]">
    <form method="POST" action="/dashboard/users/{{ $user->id }}">@csrf @method('PUT') @include('dashboard.users._form', ['user' => $user])</form>
</x-layouts.dashboard>
