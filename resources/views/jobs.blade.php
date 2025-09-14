<x-layout>
    <x-slot:heading>
        صفحة الوضائف
    </x-slot:heading>
    <h1>مرحبا بك في صفحة الوضائف</h1>
    @foreach ($jobs1 as $job)
        <ul>
            <a href="{{ route('job', $job['id']) }}">
                <li>{{ $job['title'] }} : راتبة السنوي حوالي : {{ $job['salary'] }}</li>
            </a>
        </ul>
    @endforeach
</x-layout>
