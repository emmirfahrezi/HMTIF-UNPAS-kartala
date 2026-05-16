<x-layouts.dashboard pageTitle="Edit Stat" :breadcrumbs="[['label' => 'Statistik', 'href' => '/dashboard/stats'], ['label' => 'Edit']]">
    <form method="POST" action="/dashboard/stats/{{ $stat->id }}">@csrf @method('PUT')
        @include('dashboard.stats._form')
    </form>
</x-layouts.dashboard>