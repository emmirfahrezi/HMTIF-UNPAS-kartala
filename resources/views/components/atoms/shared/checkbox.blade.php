@props([
    'name' => '',
    'id' => '',
    'checked' => false,
    'value' => '1',
    'label' => null,
])

<label class="inline-flex items-center gap-2.5 cursor-pointer group">
    <div class="relative flex items-center justify-center">
        <input 
            type="checkbox" 
            name="{{ $name }}" 
            id="{{ $id ?: $name }}" 
            value="{{ $value }}"
            @if($checked) checked @endif
            {{ $attributes->merge(['class' => 'peer appearance-none size-5 rounded-lg border-2 border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-950 checked:bg-primary checked:border-primary transition-all duration-300 focus:outline-none focus:ring-4 focus:ring-primary/10']) }}
        />
        
        {{-- Custom Check Icon --}}
        <svg 
            class="absolute size-3 text-white scale-50 opacity-0 peer-checked:scale-100 peer-checked:opacity-100 transition-all duration-300 pointer-events-none" 
            fill="none" 
            viewBox="0 0 24 24" 
            stroke="currentColor" 
            stroke-width="4"
        >
            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
        </svg>
    </div>
    
    @if($label)
        <span class="text-sm font-semibold text-slate-600 dark:text-slate-400 group-hover:text-slate-900 dark:group-hover:text-slate-200 transition-colors duration-300">
            {{ $label }}
        </span>
    @endif
</label>
