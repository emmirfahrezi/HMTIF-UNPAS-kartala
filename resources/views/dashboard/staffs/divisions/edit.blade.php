<x-layouts.dashboard pageTitle="Edit Divisi" :breadcrumbs="[['label' => 'Pengurus', 'href' => '/dashboard/staffs'], ['label' => 'Edit Divisi']]">
    <form method="POST" action="/dashboard/staffs/divisions/{{ $division->id }}">@csrf @method('PUT') @include('dashboard.staffs.divisions._form', ['division' => $division])</form>
</x-layouts.dashboard>
