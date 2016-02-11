<?php

namespace App\Models\Site;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function tagable()
    {
        return $this->morphTo();
    }

    protected $fillable = [
      'name',
      'slug',
      'tagable_id',
      'tagable_type',
    ];
}
