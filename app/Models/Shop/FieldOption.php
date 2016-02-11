<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Model;

class FieldOption extends Model
{
    protected $table = 'shop_field_options';
    public $timestamps = false;


    public function field()
    {
        return $this->belongsTo(Field::class);
    }

    protected $fillable = [
        'name','content','field_id'
    ];
}
