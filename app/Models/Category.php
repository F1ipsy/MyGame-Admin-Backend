<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['title'];

    public function questions() {
        return $this->hasMany(Question::class);
    }

    public function game() {
        return $this->belongsTo(Game::class);
    }
}
