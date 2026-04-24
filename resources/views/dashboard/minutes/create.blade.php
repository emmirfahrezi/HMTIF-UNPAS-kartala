<x-layouts.dashboard pageTitle="Tambah Notulensi" :breadcrumbs="[['label' => 'Notulensi', 'href' => '/dashboard/minutes'], ['label' => 'Tambah']]">
    <form method="POST" action="/dashboard/minutes" enctype="multipart/form-data">@csrf @include('dashboard.minutes._form', ['minute' => null])</form>
</x-layouts.dashboard>
