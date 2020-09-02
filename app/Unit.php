<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $fillable = ['name', 'user_id'];

    public function detail()
    {
        return $this->hasOne(FoodMaterial::class);
    }

    public function det()
    {
        return $this->hasOne(Detail::class);
    }
}
