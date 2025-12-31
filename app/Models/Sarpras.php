<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Sarpras extends Model
{
  protected $fillable = ['title','slug','icon','image','description','sort_order','is_active'];
  protected $casts = ['is_active'=>'boolean'];

  protected static function boot()
  {
    parent::boot();
    
    static::creating(function ($sarpras) {
      if (empty($sarpras->slug)) {
        $sarpras->slug = Str::slug($sarpras->title);
        // Ensure uniqueness
        $count = 1;
        while (static::where('slug', $sarpras->slug)->exists()) {
          $sarpras->slug = Str::slug($sarpras->title) . '-' . $count++;
        }
      }
    });
    
    static::updating(function ($sarpras) {
      if ($sarpras->isDirty('title') && empty($sarpras->slug)) {
        $sarpras->slug = Str::slug($sarpras->title);
        // Ensure uniqueness, excluding current record
        $count = 1;
        while (static::where('slug', $sarpras->slug)->where('id', '!=', $sarpras->id)->exists()) {
          $sarpras->slug = Str::slug($sarpras->title) . '-' . $count++;
        }
      }
    });
  }

  public function scopeActive($q){ return $q->where('is_active',true); }
  
  public function getImageUrlAttribute(){
    return $this->image ? asset('storage/'.$this->image) : asset('/assets/images/sarpras-placeholder.jpg');
  }
}
