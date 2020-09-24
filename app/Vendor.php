<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $connection = 'sqlsrv_server2';
    protected $table = 'GZ_VENDOR';

    protected $fillable = ['vendor_id', 'name'];

    public function demand()
    {
        return $this->hasOne(Demand::class, 'vendor_id', 'kd_vendor');
    }

    // public function head()
    // {
    //     return $this->hasOne(Head::class);
    // }

    public function receipt()
    {
        return $this->hasOne(Receipt::class, 'vendor_id', 'kd_vendor');
    }

    public function penyedia()
    {
        return $this->hasOne(Vendor2::class, 'kd_vendor', 'vendor_id');
    }
}
