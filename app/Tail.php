<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tail extends Model
{
    protected $fillable = [
        'receipt_id', 'receipt_code', 'material_id', 'unit_id', 'user_id', 'jumlah', 'keterangan'
    ];

    public function receipt()
    {
        return $this->belongsTo(Receipt::class);
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
