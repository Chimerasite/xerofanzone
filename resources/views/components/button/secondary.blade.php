<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-4 py-2 bg-stone-600 rounded-md font-semibold text-xs text-stone-50 uppercase tracking-widest shadow-sm hover:bg-stone-400 focus:outline-none focus:ring-2 focus:ring-stone-500 disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
