<span
    x-data="{ tooltip: false }"
    x-on:mouseover="tooltip = true"
    x-on:mouseleave="tooltip = false"
    class="relative inline cursor-pointer">
        {{ $slot }}
    <div x-show="tooltip"
        class="w-48 bg-stone-950 text-stone-50 text-center text-sm p-2 rounded-md absolute bottom-12 -left-20"
    >
        {{ $tooltip }}
    </div>
</span>
