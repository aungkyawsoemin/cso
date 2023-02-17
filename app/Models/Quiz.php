<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Question;

class Quiz extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "quiz";

    public function questions() {
        return $this->hasMany(Question::class);
    }

    public function showQuestions() {
        return $this->hasMany(Question::class)->where('status', STATUS_SHOW)->orderBy('sort_order', 'ASC');
    }
}
