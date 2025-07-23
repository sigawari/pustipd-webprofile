{{-- components/cards/division-card.blade.php --}}
<div
    class="bg-white dark:bg-slate-700 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 p-8 text-center group hover:-translate-y-2">
    <div class="mb-6">
        <div
            class="w-16 h-16 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center mx-auto group-hover:bg-blue-600 transition-colors duration-300">
            <i
                class="{{ $icon }} text-2xl text-blue-600 group-hover:text-white transition-colors duration-300"></i>
        </div>
    </div>

    <h3 class="text-xl font-bold mb-4 text-slate-800 dark:text-white">
        {{ $title }}
    </h3>

    <p class="text-slate-600 dark:text-slate-300 leading-relaxed">
        {{ $description }}
    </p>
</div>
