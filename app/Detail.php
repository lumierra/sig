<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    protected $fillable = ['demand_id', 'demand_code', 'material_id', 'unit_id', 'user_id', 'jumlah', 'keterangan'];

    public function demand()
    {
        return $this->belongsTo(Demand::class);
    }

    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}
