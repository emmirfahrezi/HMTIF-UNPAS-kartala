<x-dashboard-layout pageTitle="Edit Divisi" :breadcrumbs="[['label' => 'Divisi', 'href' => '/dashboard/divisions'], ['label' => 'Edit']]">
    <form method="POST" action="/dashboard/divisions/{{ $division->id }}">@csrf @method('PUT') @include('dashboard.divisions._form', ['division' => $division])</form>
</x-dashboard-layout>
