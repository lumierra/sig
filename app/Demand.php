<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Demand extends Model
{
    protected $connection = 'sqlsrv_server2';
    protected $table = 'GZ_PERMINTAAN';

    protected $fillable = ['code', 'name', 'date', 'user_id', 'vendor_id', 'head_id', 'status'];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id', 'kd_vendor');
    }

    // public function head()
    // {
    //     return $this->belongsTo(Head::class);
    // }

    public function detail()
    {
        return $this->hasMany(Detail::class);
    }
}
