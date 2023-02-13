<h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-white text-center">{{ $question != null? 'Edit': 'Create' }}
    Question</h3>


<form method="POST" action="{{ route('question.store', ['id' => $quiz->id]) }}">
    @csrf
    <input type="hidden" name="question_id" value="{{ $question != null? $question->id: 0 }}">
    <div class="grid md:grid-cols-2 md:gap-6 mb-5">
        <div class="mb-6">
            <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
            <input type="text" id="title" name="title"
                value="{{ old('title', $question != null? $question->title: '') }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                required>
        </div>
        <div class="mb-6">
            <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Visible to
                user</label>
            <div class="flex items-center mb-4">
                <input id="status-question-1" type="radio" value="0" name="status"
                    {{ old('status', $question != null? $question->status: 0) == 0? 'checked':'' }}
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="status-question-1"
                    class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300 cursor-pointer">Hide</label>
            </div>
            <div class="flex items-center">
                <input id="status-question-0" type="radio" value="1" name="status"
                    {{ old('status', $question != null? $question->status: 0) == 1? 'checked':'' }}
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="status-question-0"
                    class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300 cursor-pointer">Show</label>
            </div>
        </div>
    </div>
    <div class="grid md:grid-cols-2 md:gap-6">
        <div class="mb-6">
            <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Correct
                Description</label>
            <textarea id="description" name="description" rows="4"
                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Leave a comment...">{{ old('correct_description', $question != null? $question->correct_description: '') }}</textarea>
        </div>
        <div class="mb-6">
            <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Question
                Type</label>
            <div class="flex items-center mb-4">
                <input id="type-radio-0" type="radio" value="0" name="type"
                    {{ old('type', $question != null? $question->type: 0) == 0? 'checked':'' }}
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="type-radio-0"
                    class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300 cursor-pointer">Single
                    (True/False)
                </label>
            </div>
            <div class="flex items-center mb-4">
                <input id="type-radio-1" type="radio" value="1" name="type"
                    {{ old('type', $question != null? $question->type: 0) == 1? 'checked':'' }}
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="type-radio-1"
                    class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300 cursor-pointer">Multiple
                </label>
            </div>
            <div class="flex items-center mb-4">
                <input id="type-radio-2" type="radio" value="2" name="type"
                    {{ old('type', $question != null? $question->type: 0) == 2? 'checked':'' }}
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="type-radio-2"
                    class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300 cursor-pointer">Dropdown
                </label>
            </div>
            <div class="flex items-center">
                <input id="type-radio-3" type="radio" value="3" name="type"
                    {{ old('type', $question != null? $question->type: 0) == 3? 'checked':'' }}
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="type-radio-3"
                    class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300 cursor-pointer">Range
                </label>
            </div>
        </div>
    </div>
    <div class="grid md:gap-6">
        <div class="relative">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Correct Answer
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Visible
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <button type="button" onclick="addNewRow()"
                                class="px-3 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add</button>
                        </th>
                    </tr>
                </thead>
                <tbody class="new-sample-row">
                    @if($question != null)
                    @foreach($question->items as $row)
                    <tr>
                        <td>
                            <input type="hidden" name="item_id[]" value="{{ $row->id }}">
                            <input type="text" id="item_name" name="item_name[]" value="{{ $row->name }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required="">
                        </td>
                        <td>
                            <div class="flex items-center h-5">
                                <select id="item_correct" name="item_correct[]"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="1" {{ $row->is_correct == 1? 'selected': '' }}>Correct</option>
                                    <option value="0" {{ $row->is_correct == 0? 'selected': '' }}>Incorrect</option>
                                </select>

                            </div>
                        </td>
                        <td colspan="2">
                            <div class="flex items-center h-5">
                                <select id="item_correct" name="item_status[]"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="1" {{ $row->status == 1? 'selected': '' }}>Show</option>
                                    <option value="0" {{ $row->status == 0? 'selected': '' }}>Hide</option>
                                </select>
                            </div>
                        </td>
                        <td>
                            <!-- Empty cell -->
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    <div class="justify-between flex items-center mt-5">
        <button type="submit" data-modal-target="form-modal"
            class="take-action text-white bg-blue-700 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-blue-700 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
            Update
        </button>
        <button data-modal-target="form-modal" type="button"
            class="toggle-modal text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No,
            cancel</button>
    </div>
</form>