<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $connection = 'sqlsrv_server2';
    protected $table = 'GZ_JENIS';

    protected $fillable = ['name', 'user_id'];

    public function food()
    {
        return $this->hasOne(Food::class);
    }

    public function detail()
    {
        return $this->hasOne(FoodMaterial::class);
    }
}
