<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $fillable = ['name', 'user_id', 'category_id', 'unit_id'];

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
