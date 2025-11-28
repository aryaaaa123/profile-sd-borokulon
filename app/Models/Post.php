<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
  protected $fillable = ['title','slug','cover','category','author','excerpt','content','published_at'];
    protected $casts = ['published_at' => 'datetime']; // ✅
    public function scopePublished($q){ return $q->whereNotNull('published_at'); }
}

