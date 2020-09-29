<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $connection = 'sqlsrv_server2';
    protected $table = 'GZ_BAHAN';

    protected $fillable = ['name', 'user_id', 'category_id', 'unit_id'];

    public function detail()
    {
        return $this->hasOne(FoodMaterial::class);
    }

    public function receiptDetail()
    {
        return $this->hasOne(ReceiptDetail::class);
    }

    public function spendDetail()
    {
        return $this->hasOne(SpendDetail::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function stock()
    {
        return $this->hasOne(Stock::class);
    }
}
