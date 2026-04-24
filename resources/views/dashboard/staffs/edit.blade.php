<x-layouts.dashboard pageTitle="Edit Pengurus" :breadcrumbs="[['label' => 'Pengurus', 'href' => '/dashboard/staffs'], ['label' => 'Edit']]">
    <form method="POST" action="/dashboard/staffs/{{ $staff->id }}">
        @csrf
        @method('PUT')
        @include('dashboard.staffs._form', ['staff' => $staff])
    </form>
</x-layouts.dashboard>
