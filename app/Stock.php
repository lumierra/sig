<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = [
        'material_id', 'date', 'total', 'total_lama', 'jumlah_baru', 'jumlah_lama'
    ];

    public function material()
    {
        return $this->belongsTo(Material::class);
    }

}
