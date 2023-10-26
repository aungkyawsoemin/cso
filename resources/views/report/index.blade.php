<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Report Managment
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="relative">
                <div class="flex items-center pb-4">
                    <label for="table-search" class="sr-only">Search</label>
                    <div class="relative">
                        <form method="GET" action="{{ route('report') }}">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                            </div>
                            <input type="text" id="table-search" name="keywords" value="{{ $keywords }}" placeholder="Search for {{ $report->total() }} users by location" class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </form>
                    </div>
                    <a href="{{ route('report') }}" class="mx-3 inline-flex items-center rounded-md border border-transparent bg-gray-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        Reset
                    </a>
                    <a href="{{ route('report.export') }}" class="mx-3 inline-flex items-center rounded-md border border-transparent bg-gray-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        Export
                    </a>
                </div>
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Location {{ $keywords != ''? "(Found ".$report->total()." users)": ''}}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Occupication
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Gender
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Age
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Ethnicity
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Visit At
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($report as $row)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $row->division == null? '-': $row->division }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $row->occupication == null? '-': $row->occupication }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $row->gender == null? '-': $row->gender }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $row->age == null? '-': $row->age }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $row->ethnicity == null? '-': $row->ethnicity }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $row->updated_at }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="pt-4">
                    {{ $report->appends(request()->input())->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
