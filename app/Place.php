<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    protected $fillable = ['name'];

    public function spend()
    {
        return $this->hasOne(Spend::class);
    }
}
