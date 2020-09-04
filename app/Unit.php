<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $fillable = ['name', 'user_id', 'deskripsi'];

    public function detail()
    {
        return $this->hasOne(FoodMaterial::class);
    }

    public function det()
    {
        return $this->hasOne(Detail::class);
    }

    public function tail()
    {
        return $this->hasOne(Tail::class);
    }

    public function one()
    {
        return $this->hasOne(One::class);
    }

    public function two()
    {
        return $this->hasOne(Two::class);
    }

    public function material()
    {
        return $this->hasOne(Material::class);
    }
}
