<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FoodMaterial extends Model
{
    protected $table = 'food_material';

    protected $fillable = ['food_id', 'material_id', 'type_id', 'unit_id', 'satuan', 'keterangan'];


}
