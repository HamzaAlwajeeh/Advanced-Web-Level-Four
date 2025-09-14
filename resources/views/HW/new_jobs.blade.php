<x-layout>
    <x-slot:heading>
        صفحة الوظائف واجب
    </x-slot:heading>
    <h1>مرحبا بك في صفحة الوظائف</h1>
    @foreach ($jobs as $job)
        <a href="{{ route('job-details', $job['id']) }}" class="block mb-6">
            <div
                class="bg-white rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300 p-6 flex flex-col gap-2 border border-gray-100 hover:border-blue-400">
                <h2 class="text-xl font-bold text-gray-800 mb-2">{{ $job['title'] }}</h2>
                <p class="text-sm text-gray-500">آخر موعد للتقديم: <span
                        class="font-medium text-blue-600">{{ $job['deadline'] }}</span></p>
            </div>
        </a>
    @endforeach
</x-layout>
