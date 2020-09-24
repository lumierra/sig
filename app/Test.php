<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    protected $connection = 'sqlsrv_server2';
    protected $table = 'GZ_VENDOR';

    public function vendor()
    {
        return $this->hasOne(Vendor2::class, 'GZ_VENDOR', 'kd_vendor');
    }
}
