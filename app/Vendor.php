<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $fillable = ['name', 'description', 'user_id'];

    public function demand()
    {
        return $this->hasOne(Demand::class);
    }

    public function head()
    {
        return $this->hasOne(Head::class);
    }

    public function receipt()
    {
        return $this->hasOne(Receipt::class);
    }
}
