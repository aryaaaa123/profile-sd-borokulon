<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str; // ✅ tambahkan baris ini

class GalleryItem extends Model
{
    protected $fillable = ['title', 'image_path', 'category'];

    public function getUrlAttribute()
    {
        // jika pakai storage:link
        return Str::startsWith($this->image_path, ['http://', 'https://', '/'])
            ? $this->image_path
            : asset('storage/' . $this->image_path);
    }
}
