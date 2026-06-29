<button 
    @click="toggleDarkMode()" 
    class="relative size-10 flex items-center justify-center rounded-xl bg-slate-100 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-slate-500 dark:text-slate-400 hover:text-primary dark:hover:text-primary transition-all duration-300 group shadow-sm active:scale-95"
    title="Ganti Tema"
>
    {{-- Sun Icon --}}
    <x-heroicon-o-sun 
        x-show="darkMode" 
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="rotate-90 opacity-0 scale-50"
        x-transition:enter-end="rotate-0 opacity-100 scale-100"
        class="size-5" 
    />
 
    {{-- Moon Icon --}}
    <x-heroicon-o-moon 
        x-show="!darkMode" 
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="-rotate-90 opacity-0 scale-50"
        x-transition:enter-end="rotate-0 opacity-100 scale-100"
        class="size-5" 
    />

    {{-- Subtle Glow Effect --}}
    <span class="absolute inset-0 rounded-xl bg-primary/0 group-hover:bg-primary/5 transition-colors duration-300"></span>
</button>
