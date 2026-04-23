{{-- Form Input --}}
@props([
    'label' => '',
    'name' => '',
    'type' => 'text',
    'value' => '',
    'placeholder' => '',
    'required' => false,
    'helper' => '',
    'options' => [],
    'rows' => 4,
])

<div>
    @if ($label)
        <label for="{{ $name }}" class="block text-sm font-semibold text-slate-700 mb-1.5">
            {{ $label }}
            @if ($required)
                <span class="text-red-500">*</span>
            @endif
        </label>
    @endif

    @if ($type === 'select')
        <select name="{{ $name }}" id="{{ $name }}"
            class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition bg-white
                @error($name) border-red-300 ring-1 ring-red-200 @enderror"
            {{ $required ? 'required' : '' }}
            {{ $attributes }}>
            <option value="">— Pilih —</option>
            @foreach ($options as $optVal => $optLabel)
                <option value="{{ $optVal }}" {{ old($name, $value) == $optVal ? 'selected' : '' }}>
                    {{ $optLabel }}
                </option>
            @endforeach
        </select>
    @elseif ($type === 'textarea')
        <textarea name="{{ $name }}" id="{{ $name }}" rows="{{ $rows }}"
            placeholder="{{ $placeholder }}"
            class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition resize-y
                @error($name) border-red-300 ring-1 ring-red-200 @enderror"
            {{ $required ? 'required' : '' }}
            {{ $attributes }}>{{ old($name, $value) }}</textarea>
    @elseif ($type === 'toggle')
        <label class="inline-flex items-center gap-3 cursor-pointer">
            <input type="hidden" name="{{ $name }}" value="0" />
            <input type="checkbox" name="{{ $name }}" value="1" id="{{ $name }}"
                class="w-10 h-5 rounded-full appearance-none bg-slate-200 checked:bg-primary transition cursor-pointer relative
                    before:content-[''] before:absolute before:top-0.5 before:left-0.5 before:w-4 before:h-4 before:rounded-full before:bg-white before:transition before:shadow-sm
                    checked:before:translate-x-5"
                {{ old($name, $value) ? 'checked' : '' }}
                {{ $attributes }} />
            <span class="text-sm text-slate-600">{{ $placeholder }}</span>
        </label>
    @else
        <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}"
            value="{{ old($name, $value) }}"
            placeholder="{{ $placeholder }}"
            class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition
                @error($name) border-red-300 ring-1 ring-red-200 @enderror"
            {{ $required ? 'required' : '' }}
            {{ $attributes }} />
    @endif

    @if ($helper)
        <p class="text-xs text-slate-400 mt-1">{{ $helper }}</p>
    @endif

    @error($name)
        <p class="text-xs text-red-500 mt-1 font-medium">{{ $message }}</p>
    @enderror
</div>
