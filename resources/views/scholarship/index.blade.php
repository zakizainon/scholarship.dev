<x-app-layout :user="$user">

    @if ($user->role == 'admin')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Scholarship Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

                    <div class="overflow-x-hidden">
                        <table id="applicantTable" class="min-w-full">
                            <thead class="bg-white border-b border-gray-200 dark:bg-neutral-800 dark:border-neutral-700">
                                <tr>
                                    <th class="border-b border-gray-300 py-3 px-6 text-left">Name</th>
                                    <th class="border-b border-gray-300 py-3 px-6 text-left">Start Date</th>
                                    <th class="border-b border-gray-300 py-3 px-6 text-left">End Date</th>
                                    <th class="border-b border-gray-300 py-3 px-6 text-left">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr class="border-b border-gray-50">
                                        <td class="px-4 py-2 text-sm font-medium text-gray-800 dark:text-neutral-200">
                                            <a href="{{ route('scholarship.index', ['id' => $item->id]) }}" class="text-blue-500 hover:underline">
                                                {{ $item->name }}
                                            </a>
                                        </td>
                                        <td class="px-4 py-2 text-sm text-gray-800 dark:text-neutral-200">
                                            {{ $item->startdate }}
                                        </td>
                                        <td class="px-4 py-2 text-sm text-gray-800 dark:text-neutral-200">
                                            {{ $item->enddate }}
                                        </td>
                                        <td class="px-4 py-2 text-sm font-medium text-gray-800 dark:text-neutral-200">
                                            {{ $item->status ? 'Active' : 'Inactive' }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @if ($selectedScholarship)
                        <div id="scholarshipDetails" class="mt-6 p-4 bg-gray-100 border rounded">
                            <h3 class="text-lg font-bold mb-4">Edit Scholarship</h3>
                            <form method="POST" action="{{ route('scholarship.update', ['id' => $selectedScholarship->id]) }}">
                                @csrf
                                @method('PUT')

                                <label class="block mb-2">Name:</label>
                                <input type="text" name="name" value="{{ $selectedScholarship->name }}" class="w-1/4 p-2 border rounded">

                                <label class="block mt-4 mb-2">Start Date:</label>
                                <input type="date" name="startdate" value="{{ $selectedScholarship->startdate }}" class="w-1/4 p-2 border rounded">

                                <label class="block mt-4 mb-2">End Date:</label>
                                <input type="date" name="enddate" value="{{ $selectedScholarship->enddate }}" class="w-1/4 p-2 border rounded">

                                <label class="block mt-4 mb-2">Maximum Age:</label>
                                <input type="number" name="maxage" value="{{ $selectedScholarship->maxage }}" class="w-1/6 p-2 border rounded">

                                <label class="block mt-4 mb-2">Status:</label>
                                <select name="status" class="w-1/6 p-2 border rounded">
                                    <option value="1" {{ $selectedScholarship->status == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ $selectedScholarship->status == 0 ? 'selected' : '' }}>Inactive</option>
                                </select>

                                @php
                                    $fields = ['internalflag', 'personal', 'parentdetails', 'academics', 'spmresults', 'skills', 'experience', 'study', 'document', 'declaration', 'consent'];
                                @endphp

                                @foreach ($fields as $field)
                                    <label class="block mt-4 mb-2 capitalize">{{ str_replace('_', ' ', $field) }}:</label>
                                    <div class="flex space-x-4">
                                        <label>
                                            <input type="radio" name="{{ $field }}" value="1" {{ $selectedScholarship->$field == 1 ? 'checked' : '' }}> Yes
                                        </label>
                                        <label>
                                            <input type="radio" name="{{ $field }}" value="0" {{ $selectedScholarship->$field == 0 ? 'checked' : '' }}> No
                                        </label>
                                    </div>
                                @endforeach

                                <button type="submit" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Update</button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#applicantTable').DataTable({
                paging: true,
                info: true,
                lengthMenu: [[10, 20, 50, 100, -1], [10, 20, 50, 100, 'All']],
                pageLength: 10,
                searching: false
            });
        });
    </script>

    @else
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Unauthorized access! ') }}
            </h2>
        </x-slot>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-3 gap-4 p-4">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg col-span-2">
                    <div class="p-6 text-gray-900">            
                        You don't have the permission to view this page.      
                    </div>
                </div>
            </div>
        </div>
    @endif

</x-app-layout>
