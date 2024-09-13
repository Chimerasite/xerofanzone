<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-midnight-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-midnight-300 active:bg-midnight-300 focus:outline-none transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
