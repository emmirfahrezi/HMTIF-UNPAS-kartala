{{-- Form Section --}}
@props([
    'title' => '',
    'description' => '',
])

<div class="bg-white rounded-2xl border border-slate-200 p-6 lg:p-8">
    @if ($title)
        <div class="mb-6 pb-4 border-b border-slate-100">
            <h3 class="text-base font-bold text-slate-800">{{ $title }}</h3>
            @if ($description)
                <p class="text-sm text-slate-500 mt-1">{{ $description }}</p>
            @endif
        </div>
    @endif

    <div class="space-y-5">
        {{ $slot }}
    </div>
</div>
