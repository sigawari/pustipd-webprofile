@props(['title', 'description'])

<div class="carousel-slide flex-shrink-0 w-80 md:w-95 px-6">
    <div
        class="bg-white rounded-lg shadow-md border border-gray-200 p-8 text-center hover:shadow-xl hover:border-primary/30 transition-all duration-300 transform hover:-translate-y-2 group h-64 flex flex-col justify-between">

        <!-- Content -->
        <div class="flex-1 flex flex-col justify-center">
            <h3 class="text-xl font-bold text-gray-800 mb-4 group-hover:text-custom-blue transition-colors duration-300">
                {{ $title }}
            </h3>
            <p class="text-gray-600 leading-relaxed">
                {{ $description }}
            </p>
        </div>
    </div>
</div>
