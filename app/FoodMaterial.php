<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FoodMaterial extends Model
{
    protected $connection = 'sqlsrv_server2';
    protected $table = 'GZ_DETAIL_MAKANAN';

    protected $fillable = [
        'food_id', 'material_id', 'type_id', 'unit_id', 'jumlah', 'keterangan'
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
