<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    public function imageable()
    {
        return $this->morphTo();
    }

    protected $fillable = [
        'disk_name',
        'file_name',
        'path',
        'file_size',
        'content_type',
        'title',
        'description',
        'field',
        'imageable_id',
        'imageable_type',
        'is_public',
        'sort_order',
        'user_id'
    ];
}
