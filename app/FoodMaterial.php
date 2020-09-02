<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FoodMaterial extends Model
{
    protected $table = 'food_material';

    protected $fillable = [
        'food_id', 'material_id', 'type_id', 'unit_id', 'satuan', 'keterangan'
    ];

    public function food()
    {
        return $this->belongsTo(Food::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
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
