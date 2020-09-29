<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bed extends Model
{
    protected $connection = 'sqlsrv_server2';
    protected $table = 'VIEW_BM_KAMAR';
    protected $primaryKey = 'KD_RUANG';

    public function pasien()
    {
        return $this->belongsToMany(BmPasien::class, '');
    }

    public function ruang()
    {
        return $this->belongsToMany(RuangUnit::class, 'RUANG_UNIT', 'KD_RUANG', 'KD_RUANG');
    }

    public function test($kode)
    {
        return $this->ruang()->whereIn('KD_RUANG', $kode)->get();
    }

    public function unit()
    {
        return $this->hasMany(RuangUnit::class, 'KD_RUANG', 'KD_RUANG');
    }



}
