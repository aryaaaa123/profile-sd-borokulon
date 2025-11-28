<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sarpras extends Model
{
  protected $fillable = ['title','icon','image','description','sort_order','is_active'];
  protected $casts = ['is_active'=>'boolean'];

  public function scopeActive($q){ return $q->where('is_active',true); }
  public function getImageUrlAttribute(){
    return $this->image ? asset('storage/'.$this->image) : asset('/assets/images/sarpras-placeholder.jpg');
  }
}
