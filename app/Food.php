<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $connection = 'sqlsrv_server2';
    protected $table = 'GZ_MAKANAN';

    protected $fillable = ['name', 'user_id', 'type_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function materials()
    {
        return $this->belongsToMany(Material::class);
    }

    public function detail()
    {
        return $this->hasMany(FoodMaterial::class);
    }
}
