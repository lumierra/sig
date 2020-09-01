<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    protected $fillable = ['demand_id', 'demand_code', 'material_id', 'unit_id', 'user_id', 'jumlah', 'keterangan'];
}
