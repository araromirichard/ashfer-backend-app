<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'description'];



/**
 * 
 *Get the articles that belong to the article.
 * 
 */
public function articles(): BelongsToMany

{
    return $this->belongsToMany(Article::class);
}

    
}