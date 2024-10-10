<span
    x-data="{ tooltip: false }"
    x-on:mouseover="tooltip = true"
    x-on:mouseleave="tooltip = false"
    class="relative inline cursor-pointer">
        <i class="fa-solid fa-question-circle fa-md ml-1 text-stone-700 hover:text-teal-500"></i>
    <div x-show="tooltip"
        class="w-72 bg-stone-950 text-stone-50 text-center text-sm p-2 rounded-md absolute bottom-6 -left-32"
    >
        {{ $value }}
    </div>
</span>
