<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\QuestionItem;

class CsoUser extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "cso_users";
}
