@props([
    'label' => '',
    'id' => '',
    'error' => null,
    'required' => false,
])

<div {{ $attributes->merge(['class' => 'flex flex-col gap-2']) }}>
    @if($label)
        <label for="{{ $id }}" class="text-sm font-bold text-heading flex items-center gap-1">
            {{ $label }}
            @if($required)
                <span class="text-red-500">*</span>
            @endif
        </label>
    @endif

    {{ $slot }}

    @if($error)
        <span class="text-xs font-medium text-red-500 italic">
            {{ $error }}
        </span>
    @endif
</div>
