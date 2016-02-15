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

    public function fields()
    {
        return $this->hasMany(Field::class,'option_id');
    }

    protected $fillable = [
        'name','content','field_id'
    ];
}
