<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Student List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Search and Add User (Static) -->
                    <div class="flex flex-col md:flex-row justify-between items-center mb-6">

                        <div class="flex gap-8 pl-3">
                            <div>
                                <h1 class="text-blue-500 uppercase text-sm">Absent -
                                    <span id="absents">{{ $absents }}</span>
                                </h1>
                            </div>
                            <div>
                                <h1 class="text-red-500 uppercase text-sm">Present -
                                    <span id="presents">{{ $presents }} </span>
                                </h1>
                            </div>
                        </div>

                        <a href="https://abhirajk.vercel.app/" target="blank">
                            <button
                                class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-300">
                                Add New User
                            </button>
                        </a>
                    </div>

                    <!-- User Table -->
                    <div class="overflow-x-auto bg-white rounded-lg shadow">
                        <table class="w-full table-auto">
                            <thead>
                                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                    <th class="py-3 px-6 text-left">ID</th>
                                    <th class="py-3 px-6 text-left">Name</th>
                                    <th class="py-3 px-6 text-left">Section</th>
                                    <th class="py-3 px-6 text-left">Gender</th>
                                    <th class="py-3 px-6 text-left">Grade</th>
                                    <th class="py-3 px-6 text-left">Status</th>
                                    <th class="py-3 px-6 text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 text-sm">
                                @forelse ($students as $student)
                                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                                        <td class="py-3 px-6 text-left">{{ $student->id }}</td>
                                        <td class="py-3 px-6 text-left">{{ $student->name }}</td>
                                        <td class="py-3 px-6 text-left">{{ $student->section }}</td>
                                        <td class="py-3 px-6 text-left text-xs uppercase">{{ $student->gender }}</td>
                                        <td class="py-3 px-6 text-left">{{ $student->grade }}</td>
                                        <td class="py-3 px-6 text-left uppercase">
                                            @if ($student->status == 'absent')
                                                <span
                                                    class="text-red-500 font-medium text-xs" id="studentStatus-{{ $student->id }}">{{ $student->status }}</span>
                                            @else
                                                <span
                                                    class="text-blue-500 font-medium text-xs" id="studentStatus-{{ $student->id }}">{{ $student->status }}</span>
                                            @endif
                                        </td>

                                        <td class="py-3 flex item-center gap-3 justify-center">

                                            @if ($student->status == 'absent')
                                                <form action="{{ route('students.status', encrypt($student->id)) }}"
                                                    method="POST">
                                                    <input type="hidden" name="status"
                                                        value="{{ $student->status }}">
                                                    @csrf
                                                    <button type="submit"
                                                        class="border border-red-300 py-1.5 px-3 rounded transform hover:text-blue-500 text-[11px] hover:scale-110 uppercase">
                                                        Present
                                                    </button>
                                                </form>
                                            @else
                                                <form action="{{ route('students.status', encrypt($student->id)) }}"
                                                    method="POST">
                                                    <input type="hidden" name="status"
                                                        value="{{ $student->status }}">
                                                    @csrf
                                                    <button type="submit"
                                                        class="border border-red-300 py-1.5 px-3 rounded transform hover:text-red-500 text-[11px] hover:scale-110 uppercase">
                                                        Absent
                                                    </button>
                                                </form>
                                            @endif

                                            <a href="{{ route('students.edit', encrypt($student->id)) }}"
                                                class="border border-red-300 py-1.5 px-3 rounded transform hover:text-blue-500 text-[11px] hover:scale-110 uppercase">Edit
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td>No Data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
