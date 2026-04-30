<x-layouts.dashboard pageTitle="Edit Aspirasi" :breadcrumbs="[['label' => 'Aspirasi', 'href' => '/dashboard/aspirations'], ['label' => 'Edit']]">
    <form method="POST" action="/dashboard/aspirations/{{ $aspiration->id }}">@csrf @method('PUT') @include('dashboard.aspirations._form', ['aspiration' => $aspiration])</form>
</x-layouts.dashboard>

