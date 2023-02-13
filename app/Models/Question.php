<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\QuestionItem;

class Question extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "questions";

    public function items() {
        return $this->hasMany(QuestionItem::class);
    }
}
