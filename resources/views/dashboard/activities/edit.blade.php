<x-layouts.dashboard pageTitle="Edit Kegiatan" :breadcrumbs="[['label' => 'Kegiatan', 'href' => '/dashboard/activities'], ['label' => 'Edit']]">
    <form method="POST" action="/dashboard/activities/{{ $activity->id }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('dashboard.activities._form', ['activity' => $activity])
        
        <div class="mt-12 flex items-center justify-end gap-3">
            <x-atoms.shared.button 
                variant="secondary"
                href="/dashboard/activities">
                Batal
            </x-atoms.shared.button>
            <x-atoms.shared.button 
                type="submit">
                Simpan Perubahan
            </x-atoms.shared.button>
        </div>
    </form>
</x-layouts.dashboard>

