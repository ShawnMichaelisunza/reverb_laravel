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
                    <form action="{{ route('students.update', encrypt($student->id)) }}" method="POST">
                        @csrf
                        @method('put')

                        <div class="grid grid-cols-2 gap-3">
                            <div class="grid gap-1 col-span-2">
                                <label for="" class="text-blue-500 uppercase font-semibold">Name</label>
                                <input type="text" name="name"
                                    class="p-2 border rounded text-gray-500 text-xs uppercase border-red-300"
                                    value="{{ $student->name }}">
                            </div>
                            <div class="grid gap-1">
                                <label for="" class="text-blue-500 uppercase font-semibold">Section</label>
                                <input type="text" name="section"
                                    class="p-2 border rounded text-gray-500 text-xs uppercase border-red-300"
                                    value="{{ $student->section }}">
                            </div>
                            <div class="grid gap-1">
                                <label for="" class="text-blue-500 uppercase font-semibold">Grade</label>
                                <input type="text" name="grade"
                                    class="p-2 border rounded text-gray-500 text-xs uppercase border-red-300"
                                    value="{{ $student->grade }}">
                            </div>
                            <div class="grid gap-1">
                                <label for="" class="text-blue-500 uppercase font-semibold">Gender</label>
                                <select name="gender"
                                    class="p-2 border rounded text-gray-500 text-xs uppercase border-red-300">
                                    <option value="" selected disabled>select gender</option>
                                    <option value="male"
                                        {{ old('gender', $student->gender) == 'male' ? 'selected' : '' }}>Male
                                    </option>
                                    <option value="female"
                                        {{ old('gender', $student->gender) == 'female' ? 'selected' : '' }}>Female
                                    </option>

                                </select>
                            </div>
                            <div class="grid gap-1">
                                <label for="" class="text-blue-500 uppercase font-semibold">Status</label>
                                <select name="status" id=""
                                    class="p-2 border rounded text-gray-500 text-xs uppercase border-red-300">
                                    <option value="" selected disabled>select status</option>
                                    <option value="present"
                                        {{ old('status', $student->status) == 'present' ? 'selected' : '' }}>Present
                                    </option>
                                    <option value="absent"
                                        {{ old('status', $student->status) == 'absent' ? 'selected' : '' }}>Absent
                                    </option>

                                </select>
                            </div>
                        </div>

                        <button type="submit"
                            class="mt-10 border-0 bg-green-500 text-white py-1.5 px-4 rounded ">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
