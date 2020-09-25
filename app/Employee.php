<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $connection = 'sqlsrv_hrd';
    protected $table = 'HRD_KARYAWAN';

    public function head()
    {
        return $this->belongsTo(Head::class, 'GZ_PENANGGUNG_JAWAB', 'head_id', 'KD_KARYAWAN');
    }

    public function user()
    {
      return $this->belongsTo(User::class, 'GZ_USERS', 'employee_id', 'KD_KARYAWAN');
    }
}
