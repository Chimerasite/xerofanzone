<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-teal-500 border border-transparent rounded-md font-semibold text-xs text-stone-50 uppercase tracking-widest hover:bg-teal-300 active:bg-teal-300 focus:outline-none transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
