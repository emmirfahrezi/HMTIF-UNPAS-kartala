@props([
    'id' => '',
    'label' => '',
    'required' => false,
    'error' => null,
])

<div class="space-y-2">
    @if($label)
        <label for="{{ $id }}" class="block text-sm font-semibold text-slate-700">
            {{ $label }}
            @if($required)
                <span class="text-red-500">*</span>
            @endif
        </label>
    @endif
    
    <div class="relative">
        {{ $slot }}
    </div>

    @if($error)
        <p class="text-xs text-red-500 font-medium">{{ $error }}</p>
    @endif
</div>
