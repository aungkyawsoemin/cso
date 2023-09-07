<x-app-layout>
    <x-slot name="header">
        <div class="lg:flex lg:items-center lg:justify-between">
            <div class="min-w-0 flex-1">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Edit Assessment
                </h2>
            </div>
            <div class="mt-5 flex lg:mt-0 lg:ml-4">
                <span class="sm:ml-3">
                    <a href="{{ route('quiz') }}"
                        class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                        Back
                    </a>
                </span>
            </div>
        </div>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <ul
                class="tab text-sm font-medium text-center text-gray-500 divide-x divide-gray-200 rounded-lg shadow sm:flex dark:divide-gray-700 dark:text-gray-400">
                <li class="w-full">
                    <a href="#detail"
                        class="active inline-block w-full p-4 bg-white rounded-l-lg focus:outline-none hover:text-gray-700 hover:bg-gray-50 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
                        data-action="tab-trigger" data-target="quizContent" data-tab="detail">Detail</a>
                </li>
                <li class="w-full">
                    <a href="#questions"
                        class="inline-block w-full p-4 bg-white rounded-r-lg focus:outline-none hover:text-gray-700 hover:bg-gray-50 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
                        data-action="tab-trigger" data-target="quizContent" data-tab="questions">Questions</a>
                </li>
            </ul>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-5" data-tab-id="quizContent">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg px-10 py-10"
                data-tab-name="detail">
                <form method="POST" action="{{ route('quiz.store', ['id' => $quiz->id]) }}">
                    @csrf
                    <div class="grid md:grid-cols-2 md:gap-6 mb-5">
                        <div class="mb-6">
                            <label for="name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $quiz->name) }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required>
                        </div>
                        <div class="mb-6">
                            <label for="description"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Visible to
                                user</label>
                            <div class="flex items-center mb-4">
                                <input id="status-radio-1" type="radio" value="0" name="status"
                                    {{ old('status', $quiz->status) == 0? 'checked':'' }}
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="status-radio-1"
                                    class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300 cursor-pointer">Hide</label>
                            </div>
                            <div class="flex items-center">
                                <input id="status-radio-0" type="radio" value="1" name="status"
                                    {{ old('status', $quiz->status) == 1? 'checked':'' }}
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="status-radio-0"
                                    class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300 cursor-pointer">Show</label>
                            </div>
                        </div>
                    </div>
                    <div class="grid md:grid-cols-2 md:gap-6">
                        <div class="mb-6">
                            <label for="description"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                            <textarea id="description" name="description" rows="4"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Leave a comment...">{{ old('name', $quiz->description) }}</textarea>
                        </div>
                        <div class="mb-6">
                            <label for="description"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Difficulty
                                Level</label>
                            <div class="flex items-center mb-4">
                                <input id="level-radio-0" type="radio" value="0" name="level"
                                    {{ old('level', $quiz->level) == 0? 'checked':'' }}
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="level-radio-0"
                                    class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300 cursor-pointer">Easy Level</label>
                            </div>
                            <div class="flex items-center mb-4">
                                <input id="level-radio-1" type="radio" value="1" name="level"
                                    {{ old('level', $quiz->level) == 1? 'checked':'' }}
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="level-radio-1"
                                    class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300 cursor-pointer">Medium
                                    Level</label>
                            </div>
                            <div class="flex items-center">
                                <input id="level-radio-2" type="radio" value="2" name="level"
                                    {{ old('level', $quiz->level) == 2? 'checked':'' }}
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="level-radio-2"
                                    class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300 cursor-pointer">Hard Level</label>
                            </div>
                        </div>
                    </div>
                    <div class="grid md:grid-cols-2 md:gap-6">
                        <div class="mb-6">
                            <label for="course-title"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Course Title</label>
                            <input type="text" id="course-title" name="course_name" value="{{ old('course_name', $quiz->course_name) }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required>

                            <label for="course-description"
                                class="block mb-2 mt-5 text-sm font-medium text-gray-900 dark:text-white">Course Description</label>
                            <textarea id="course-description" name="course_description" rows="4"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Leave a comment...">{{ old('course_description', $quiz->course_description) }}</textarea>

                            <label for="course-link"
                                class="block mb-2 mt-5 text-sm font-medium text-gray-900 dark:text-white">Course Link</label>
                            <input type="text" id="course-link" name="course_link" value="{{ old('course_link', $quiz->course_link) }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required>
                        </div>
                    </div>
                    <div class="justify-between flex items-center">
                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Update
                        </button>
                        <div>
                            <button type="reset" data-modal-target="popup-modal"
                                class="toggle-modal text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Delete</button>
                            <a href="{{ route('quiz') }}"
                                class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg px-5 py-10 hidden"
                data-tab-name="questions">
                <div class="max-w-7xl mx-auto">
                    <div class="relative">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3" style="max-width: 30%;">
                                        Name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Visible
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Type
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($questions) > 0)
                                @php
                                    $status = ['Hide', 'Show'];
                                    $types = ['Single', 'Multiple', 'Dropdown', 'Range'];
                                @endphp
                                @foreach($questions as $row)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            @if(Str::wordCount($row->title) >= 15)
                                            {{ Str::padRight(Str::substr($row->title, 0, 100)."...", 10) }}
                                            @else
                                            {{ $row->title }}
                                            @endif
                                        </th>
                                        <td>
                                            {{ $status[$row->status] }}
                                        </td>
                                        <td>
                                            {{ $types[$row->type] }}
                                        </td>
                                        <td class="text-center">
                                            <a onclick="showQuestionModal({{ $row->id }})" data-modal-target="form-modal" class="toggle-modal cursor-pointer font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                        </td>
                                    </tr>
                                @endforeach
                                @endif
                                <tr>
                                    <td colspan="4" scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                        <a href="#" onclick="showQuestionModal();" data-modal-target="form-modal" class="toggle-modal mx-auto text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                        Create new question</a>
                                    </td>
                                <tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('extra_components')
    <div id="popup-modal" tabindex="-1"
        class="modal fixed hidden inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
        <div class="relative w-full h-full max-w-md md:h-auto mx-auto">
            <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                <div class="p-6 text-center">
                    <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to
                        delete this user?</h3>
                    <a href="{{ route('user.delete', ['id' => $quiz->id]) }}" data-modal-target="popup-modal"
                        class="take-action text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                        Yes, I'm sure
                    </a>
                    <button data-modal-target="popup-modal" type="button"
                        class="toggle-modal text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No,
                        cancel</button>

                    <div id="action-loading-icon">
                        <div role="status">
                            <svg aria-hidden="true"
                                class="mx-auto w-8 h-8 mr-2 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                                viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg"
                                style="margin: 0px auto;">
                                <path
                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                    fill="currentColor" />
                                <path
                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                    fill="currentFill" />
                            </svg>
                            <span class="sr-only">Loading...</span>
                        </div>
                        <span class="mt-5 text-lg font-normal text-gray-500 dark:text-gray-400">In progress...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="form-modal" tabindex="-1"
        class="modal fixed hidden inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
        <div class="relative w-full h-full md:h-auto mx-auto">
            <div class="relative top-20 mx-auto p-5 border w-3/4 shadow-lg rounded-md bg-white dark:bg-gray-600">
                <div class="p-6">
                    <div id="form-modal-body">

                    </div>
                </div>
            </div>
        </div>
    </div>
    @endpush

    @push('custom_scripts')
    <script>
        var ajaxurl = "{{ route('question.edit', ['id' => $quiz->id]) }}";
        async function showQuestionModal(question_id = 0) {
            var html = '';
            $('#form-modal-body').html(html);
            html = await $.ajax({
                url: ajaxurl,
                type: 'POST',
                data: {
                    _token: '<?php echo csrf_token() ?>',
                    question_id: question_id
                },
            });
            $('#form-modal-body').html(html);
        }

        function addNewRow() {
            var html = `<tr><td>
                        <input type="hidden" name="item_id[]" value="0">
                        <input type="text" id="item_name" name="item_name[]" value="" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                        </td><td><div class="flex items-center h-5">
                        <select id="item_correct" name="item_correct[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
  <option value="1" selected>Correct</option>
  <option value="0">Incorrect</option>
</select>

                        </div></td><td><div class="flex items-center h-5">
                        <select id="item_correct" name="item_status[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
  <option value="1" selected>Show</option>
  <option value="0">Hide</option>
</select>
                        </div></td><td><!-- Empty cell --></td></tr>`;
            $('tbody.new-sample-row').append(html)
        }
    </script>
    @endpush
</x-app-layout>