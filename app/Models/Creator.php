<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Creator extends Model
{
    use HasFactory;

    protected $fillable = [
        'is_post_locked', 'expertise', 'description', 'genres'
    ];

    protected $casts = [
        'genres' => 'array'
    ];
}
