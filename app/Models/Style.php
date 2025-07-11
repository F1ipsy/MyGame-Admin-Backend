<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Style extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'path'];

    public function game()
    {
        return $this->hasMany(Game::class);
    }
}
