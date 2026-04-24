<x-layouts.dashboard pageTitle="Edit Notulensi" :breadcrumbs="[['label' => 'Notulensi', 'href' => '/dashboard/minutes'], ['label' => 'Edit']]">
    <form method="POST" action="/dashboard/minutes/{{ $minute->id }}" enctype="multipart/form-data">@csrf @method('PUT') @include('dashboard.minutes._form', ['minute' => $minute])</form>
</x-layouts.dashboard>
