<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Head extends Model
{
    protected $connection = 'sqlsrv_server2';
    protected $table = 'GZ_PENANGGUNG_JAWAB';

    protected $fillable = ['name', 'head_id'];

    public function employee()
    {
        return $this->hasOne(Employee::class, 'KD_KARYAWAN', 'head_id');
    }

    public function demand()
    {
        return $this->hasOne(Demand::class, 'head_id', 'head_id');
    }

    public function receipt()
    {
        return $this->hasOne(Receipt::class, 'head_id', 'head_id');
    }
}
