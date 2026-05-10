<x-layouts.dashboard pageTitle="Edit Log Aktivitas" :breadcrumbs="[['label' => 'Log Aktivitas', 'href' => '/dashboard/activity-logs'], ['label' => 'Edit']]">
    <form method="POST" action="/dashboard/activity-logs/{{ $activityLog->id }}">
        @csrf
        @method('PUT')
        @include('dashboard.activity-logs._form', ['activityLog' => $activityLog])
    </form>
</x-layouts.dashboard>
