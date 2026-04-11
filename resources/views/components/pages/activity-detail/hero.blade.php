@php
    $activity = \App\Models\Activity::query()->latest('start_date')->first();
@endphp

{{-- Hero Section for Activity Detail --}}
<x-molecules.sections.page-hero badge="Detail Program Kerja" :title="$activity ? \Illuminate\Support\Str::limit($activity->title, 20, '') : 'Aksi'" highlight="Kartala" :description="$activity?->description ?:
    'Transformasi Kepemimpinan untuk Informatika yang Progresif. teknik informatika progresif.'" />
