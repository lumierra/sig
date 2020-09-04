<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
      'name', 'description',
    ];

    public function material()
    {
        return $this->hasOne(Material::class);
    }
}
