<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\QuestionItem;

class QuizController extends Controller
{
    public function index(Request $request)
    {
        $keywords = $request->get('keywords');
        $query = Quiz::where('id', '<>', 0);
        if($keywords != '') $query->where('name', 'like', '%'.$keywords.'%');
        $quiz = $query->paginate();

        return view('quiz.index', ['quiz' => $quiz, 'keywords' => $keywords]);
    }

    public function create(Request $request)
    {
        $quiz = new Quiz;
        $quiz->name = $request->get('quiz_name');
        $quiz->description = "";
        $quiz->save();

        return redirect()->route('quiz.edit', ['id' => $quiz->id]);
    }

    public function edit(Request $request, $id) {
        $quiz = Quiz::findOrFail($id);
        $questions = $quiz->questions;
        return view('quiz.form', ['quiz' => $quiz, 'questions' => $questions]);
    }

    public function store(Request $request, $id) {
        $quiz = Quiz::findOrFail($id);
        $quiz->name = $request->get('name');
        $quiz->description = $request->get('description');
        $quiz->status = $request->get('status');
        $quiz->level = $request->get('level');
        $quiz->course_name = $request->get('course_name');
        $quiz->course_description = $request->get('course_description');
        $quiz->course_link = $request->get('course_link');
        $quiz->save();

        return redirect()->route('quiz.edit', ['id' => $quiz->id])->with('status', 'Assessment data is successfully stored');
    }

    public function editQuestion(Request $request, $quiz_id) {
        $quiz = Quiz::find($quiz_id);
        $question = Question::find($request->get('question_id'));
        return view('quiz.question', ['quiz' => $quiz, 'question' => $question]);
    }

    public function storeQuestion(Request $request, $quiz_id) {
        $question = $request->get('question_id') > 0? Question::find($request->get('question_id')): new Question;
        $question->quiz_id = $quiz_id;
        $question->sort_order = 0;
        $question->status = $request->get('status');
        $question->type = $request->get('type');
        $question->title = $request->get('title');
        $question->correct_description = $request->get('description');
        $question->save();

        foreach($request->get('item_name') as $key => $value) {
            $item = $request->get('item_id')[$key]== 0? new QuestionItem: QuestionItem::find($request->get('item_id')[$key]);
            $item->question_id = $question->id;
            $item->sort_order = $key;
            $item->name = $request->get('item_name')[$key];
            $item->is_correct = $request->get('item_correct')[$key];
            $item->status = $request->get('item_status')[$key];
            $item->save();
        }

        return redirect()->route('quiz.edit', ['id' => $quiz_id]);
    }
}
