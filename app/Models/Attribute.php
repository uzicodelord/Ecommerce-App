<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $fillable = ['name', 'value'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
