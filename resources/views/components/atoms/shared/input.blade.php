@props([
    'disabled' => false,
])

<input {{ $disabled ? 'disabled' : '' }} {{ $attributes->merge(['class' => 'w-full px-4 py-3 bg-white dark:bg-slate-950/45 border border-slate-200/50 dark:border-slate-800/70 rounded-2xl focus:ring-4 focus:ring-primary/10 focus:border-primary outline-none transition-all duration-300 placeholder:text-slate-400 dark:placeholder:text-slate-600 text-slate-700 dark:text-white font-medium shadow-sm disabled:opacity-50 disabled:cursor-not-allowed']) }}>

