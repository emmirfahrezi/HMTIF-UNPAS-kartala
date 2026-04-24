<x-layouts.dashboard pageTitle="Edit Kegiatan" :breadcrumbs="[['label' => 'Kegiatan', 'href' => '/dashboard/activities'], ['label' => 'Edit']]">
    <form method="POST" action="/dashboard/activities/{{ $activity->id }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('dashboard.activities._form', ['activity' => $activity])
    </form>
</x-layouts.dashboard>
