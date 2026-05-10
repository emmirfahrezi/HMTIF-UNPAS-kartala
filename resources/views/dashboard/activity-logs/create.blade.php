<x-layouts.dashboard pageTitle="Tambah Log Aktivitas" :breadcrumbs="[['label' => 'Log Aktivitas', 'href' => '/dashboard/activity-logs'], ['label' => 'Tambah']]">
    <form method="POST" action="/dashboard/activity-logs">
        @csrf
        @include('dashboard.activity-logs._form', ['activityLog' => null])
    </form>
</x-layouts.dashboard>
