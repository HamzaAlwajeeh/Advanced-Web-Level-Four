<x-layout>
    <x-slot:heading>
        المستخدمين
    </x-slot:heading>
    <div class="overflow-x-auto">
        <table class="table-auto w-full border-collapse rounded-3xl overflow-hidden shadow-lg">
            <thead>
                <tr class="bg-gradient-to-r from-purple-700 to-indigo-600 text-white text-sm uppercase">
                    <th class="px-6 py-4">الرقم</th>
                    <th class="px-6 py-4">الاسم الأول</th>
                    <th class="px-6 py-4">الاسم الثاني</th>
                    <th class="px-6 py-4">العمر</th>
                    <th class="px-6 py-4">التخصص</th>
                    <th class="px-6 py-4">اسم المهمة</th>
                </tr>
            </thead>
            @foreach ($employees as $employee)
                <tbody class="text-gray-700 text-center text-sm">
                    <tr class="bg-white border-b hover:bg-blue-50 transition duration-300">
                        <td class="px-6 py-4">{{ $employee->id }}</td>
                        <td class="px-6 py-4">{{ $employee->firstName }}</td>
                        <td class="px-6 py-4">{{ $employee->lastName }}</td>
                        <td class="px-6 py-4">{{ $employee->Age }}</td>
                        <td class="px-6 py-4">{{ $employee->job }}</td>
                        {{-- <td class="px-6 py-4">{{ $taskTitle->title }}</td> --}}


                        {{-- <td class="px-6 py-4">{{ $employee->tasks->title }}</td> --}}
                    </tr>
            @endforeach
            </tbody>
        </table>
    </div>

</x-layout>
