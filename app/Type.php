<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $fillable = ['name', 'user_id'];

    public function food()
    {
        return $this->hasOne(Food::class);
    }
}
