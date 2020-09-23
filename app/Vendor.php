<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $connection = 'sqlsrv_2';
    protected $table = 'vendor';

    // protected $fillable = ['name', 'description', 'user_id'];

    public function demand()
    {
        return $this->hasOne(Demand::class, 'vendor_id', 'kd_vendor');
    }

    // public function head()
    // {
    //     return $this->hasOne(Head::class);
    // }

    // public function receipt()
    // {
    //     return $this->hasOne(Receipt::class);
    // }
}
