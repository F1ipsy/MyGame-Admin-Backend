<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;
    protected $fillable = ['title', "status"];

    public function categories() {
        return $this->hasMany(Category::class);
    }

    public function style()
    {
        return $this->belongsTo(Style::class);
    }
}
