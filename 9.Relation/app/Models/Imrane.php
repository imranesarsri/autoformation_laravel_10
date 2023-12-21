<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imrane extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'slug',
        'content',
    ];
}