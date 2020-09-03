<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class One extends Model
{
    protected $fillable = [
      'spend_id' , 'spend_code', 'material_id', 'unit_id', 'user_id', 'jumlah', 'keterangan',
    ];

    public function spend()
    {
        return $this->belongsTo(Spend::class);
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
