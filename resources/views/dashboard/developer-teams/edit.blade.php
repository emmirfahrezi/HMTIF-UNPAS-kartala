@php
    $periodSlug = str_replace('/', '-', $period);
@endphp

<x-layouts.dashboard pageTitle="Edit Tim Pengembang" :breadcrumbs="[['label' => 'Tim Pengembang', 'href' => '/dashboard/developer-teams'], ['label' => 'Edit']]">
    <form method="POST" action="/dashboard/developer-teams/{{ $periodSlug }}" class="space-y-8">
        @csrf
        @method('PUT')

        @include('dashboard.developer-teams._form', ['period' => $period, 'content' => $content])

        <div class="flex justify-end gap-3">
            <x-atoms.shared.button variant="ghost" href="/dashboard/developer-teams">
                Batal
            </x-atoms.shared.button>
            <x-atoms.shared.button type="submit" icon="heroicon-o-check">
                Simpan Perubahan
            </x-atoms.shared.button>
        </div>
    </form>
</x-layouts.dashboard>
