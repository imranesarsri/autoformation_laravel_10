<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use App\Models\Categorie;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'content',
        'categorie_id',
    ];
    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}