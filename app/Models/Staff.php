<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Staff extends Model
{
    protected $table = 'staff';
    protected $fillable = ['name','role','subject','position','photo','is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function getPhotoUrlAttribute(): string
    {
        if (!$this->photo) return asset('assets/images/avatar-placeholder.png');
        return Str::startsWith($this->photo, ['http://','https://','/'])
            ? $this->photo
            : asset('storage/'.$this->photo);
    }
}
