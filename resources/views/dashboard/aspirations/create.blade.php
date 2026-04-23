<x-dashboard-layout pageTitle="Tambah Aspirasi" :breadcrumbs="[['label' => 'Aspirasi', 'href' => '/dashboard/aspirations'], ['label' => 'Tambah']]">
    <form method="POST" action="/dashboard/aspirations">@csrf @include('dashboard.aspirations._form', ['aspiration' => null])</form>
</x-dashboard-layout>
