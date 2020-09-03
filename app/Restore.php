<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restore extends Model
{
    protected $fillable = [
        'code', 'date', 'dari', 'name', 'status', 'user_id',
    ];

    public function detail()
    {
        return $this->hasMany(Two::class);
    }
}
