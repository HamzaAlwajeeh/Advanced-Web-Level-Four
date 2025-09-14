<x-layout>
    <x-slot:heading>
        صفحة الوضيفه
    </x-slot:heading>
    <dl>{{ $job['title'] }}</dl>
    <dd> راتبة السنوي حوالي : {{ $job['salary'] }}</dd>
</x-layout>
