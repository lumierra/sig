<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = [
        'material_id', 'date', 'total', 'total_lama',
    ];


}
