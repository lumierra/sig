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
}
