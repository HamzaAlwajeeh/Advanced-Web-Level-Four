<x-layout>
    <x-slot:heading>
        واجب تفاصيل الوظيفه
    </x-slot:heading>
    <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-lg p-8 mt-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-4 border-b pb-2">{{ $job['title'] }}</h1>
        <div class="mb-6">
            <span class="block text-gray-600 font-semibold mb-1">الوصف الوظيفي:</span>
            <p class="text-gray-700">{{ $job['description'] }}</p>
        </div>
        <div class="mb-6">
            <span class="block text-gray-600 font-semibold mb-1">المهام:</span>
            <ul class="list-disc list-inside text-gray-700">

                <li>{{ $job['tasks'] }}</li>

            </ul>
        </div>

        <div class="mb-6">
            <span class="block text-gray-600 font-semibold mb-1">المهارات المطلوبة:</span>
            <li>{{ $job['skill'] }}</li>
        </div>

        <div class="mb-4">
            <span class="block text-gray-600 font-semibold mb-1">الخبرة المطلوبة:</span>
            <p class="text-gray-700">{{ $job['experience'] }}</p>
        </div>
        <div>
            <span class="block text-gray-600 font-semibold mb-1">آخر موعد للتقديم:</span>
            <p class="text-red-600 font-bold">{{ $job['deadline'] }}</p>
        </div>
    </div>
</x-layout>
