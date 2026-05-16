<x-layouts.dashboard pageTitle="Tambah Stat" :breadcrumbs="[['label' => 'Statistik', 'href' => '/dashboard/stats'], ['label' => 'Tambah']]">
    <form method="POST" action="/dashboard/stats">@csrf
        @include('dashboard.stats._form', ['stat' => null])
    </form>
</x-layouts.dashboard>