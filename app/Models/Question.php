<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'desc',
        'question',
        'category_id',
        'answer',
        'answer_desc',
        'points',
        'answer_type',
        'question_type',
        'question_file',
        'answer_file'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
