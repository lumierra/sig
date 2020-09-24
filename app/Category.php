<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $connection = 'sqlsrv_server2';
    protected $table = 'GZ_KATEGORI';

    protected $fillable = [
      'name', 'description',
    ];

    public function material()
    {
        return $this->hasOne(Material::class);
    }
}
