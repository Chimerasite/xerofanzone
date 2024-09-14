<button {{ $attributes->merge(['type' => 'submit', 'class' => 'hover:text-teal-500 active:text-teal-500 transition focus:outline-none ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
