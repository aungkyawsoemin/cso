<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\QuestionItem;

class QuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(env('APP_ENV') == 'production') {
            return false;
        }
        Quiz::truncate();
        Question::truncate();
        QuestionItem::truncate();

        $faker = \Faker\Factory::create();
        $question_count = 5;

        for($i = 0; $i < 30; $i++) {
            $quiz = new Quiz;
            $quiz->name = $faker->realText(50, 1);
            $quiz->description = $faker->realText(200, 3);
            $quiz->status = STATUS_SHOW;
            $quiz->level = QUIZ_LEVEL_MEDIUM;
            $quiz->question_count = $question_count;
            $quiz->thumbnail_url = 'images/placeholder.webp';
            $quiz->save();
        }
        
        $quizzes = Quiz::get();
        foreach($quizzes as $quiz) {
            $questions = [];
            for($i = 0;  $i < $question_count; $i++) {
                $questions[] = [
                    'quiz_id' => $quiz->id,
                    'sort_order' => $i,
                    'status' => STATUS_SHOW,
                    'score' => rand(10, 99),
                    'title' => $faker->realText(20, 1),
                    'correct_description' => $faker->realText(100, 3),
                    'type' => QUESTION_TYPE_SINGLE,
                    'thumbnail_url' => 'images/placeholder.webp',
                ];
            }
            Question::insert($questions);
        }

        $questions = Question::get();
        foreach($questions as $quest) {
            $items = []; 
            for($i = 0; $i < 2; $i++) {
                $items[] = [
                    'question_id' => $quest->id,
                    'sort_order' => $i,
                    'status' => STATUS_SHOW,
                    'name' => $faker->realText(20, 1),
                    'is_correct' => $i == 0? INCORRECT_ANSWER: CORRECT_ANSWER,
                ];
            }
            QuestionItem::insert($items);
        }
    }
}
