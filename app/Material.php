<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $fillable = ['name', 'user_id', 'category_id', 'unit_id'];

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
}
