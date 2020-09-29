<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RuangUnit extends Model
{
    protected $connection = 'sqlsrv_server2';
    protected $table = 'RUANG_UNIT';

    public function bed()
    {
        return $this->belongsTo(Bed::class, 'KD_RUANG', 'KD_RUANG');
    }

    public function pasien()
    {
        return $this->belongsTo(BmPasien::class);
    }
}
