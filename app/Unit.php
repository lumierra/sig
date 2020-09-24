<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $connection = 'sqlsrv_server2';
    protected $table = 'GZ_SATUAN';

    protected $fillable = ['name', 'user_id', 'deskripsi'];

    public function detail()
    {
        return $this->hasOne(FoodMaterial::class);
    }

    public function det()
    {
        return $this->hasOne(Detail::class);
    }

    public function tail()
    {
        return $this->hasOne(Tail::class);
    }

    public function receiptDetail()
    {
        return $this->hasOne(ReceiptDetail::class);
    }

    public function one()
    {
        return $this->hasOne(One::class);
    }

    public function spendDetail()
    {
        return $this->hasOne(SpendDetail::class);
    }

    public function two()
    {
        return $this->hasOne(Two::class);
    }

    public function material()
    {
        return $this->hasOne(Material::class);
    }
}
