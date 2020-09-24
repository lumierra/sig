<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendor2 extends Model
{
    protected $connection = 'sqlsrv_server';
    protected $table = 'vendor';


    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'GZ_VENDOR', 'vendor_id', 'kd_vendor');
    }

}
