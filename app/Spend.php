<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spend extends Model
{
    protected $fillable = [
      'code', 'date', 'tujuan', 'name', 'status', 'user_id', 'place_id',
    ];

    public function detail()
    {
        return $this->hasMany(One::class);
    }

    public function place()
    {
        return $this->belongsTo(Place::class);
    }

}
