{{-- Flash Message --}}
@if (session('success') || session('error') || session('warning'))
    @php
        $type = session('success') ? 'success' : (session('error') ? 'error' : 'warning');
        $message = session($type);
        $colors = [
            'success' => 'bg-emerald-50 border-emerald-200 text-emerald-800',
            'error' => 'bg-red-50 border-red-200 text-red-800',
            'warning' => 'bg-amber-50 border-amber-200 text-amber-800',
        ];
        $icons = [
            'success' => 'heroicon-o-check-circle',
            'error' => 'heroicon-o-x-circle',
            'warning' => 'heroicon-o-exclamation-circle',
        ];
    @endphp

    <div id="flashMessage"
        class="mx-6 lg:mx-8 mt-4 flex items-center gap-3 px-5 py-3.5 rounded-xl border {{ $colors[$type] }} transition-opacity duration-500">
        <x-dynamic-component :component="$icons[$type]" class="size-5 shrink-0" />
        <p class="text-sm font-medium flex-1">{{ $message }}</p>
        <button onclick="document.getElementById('flashMessage').remove()"
            class="p-1 rounded-lg hover:bg-black/5 transition">
            <x-heroicon-o-x-mark class="size-4" />
        </button>
    </div>

    <script>
        setTimeout(function() {
            const el = document.getElementById('flashMessage');
            if (el) {
                el.style.opacity = '0';
                setTimeout(function() { el.remove(); }, 500);
            }
        }, 5000);
    </script>
@endif
