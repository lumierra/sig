<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $connection = 'sqlsrv_server2';
    protected $table = 'KAMAR';

    protected $fillable = ['name', 'description'];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function bmpasien()
    {
        return $this->belongsTo(BmPasien::class, 'KD_UNIT', 'KD_UNIT');
    }

    public function pasien()
    {
        return $this->hasMany(BmPasien::class, 'KD_UNIT', 'KD_UNIT');
    }

    public function data()
    {
        return $this->hasOne(BmPasien::class, 'KD_UNIT', 'KD_UNIT');
    }

    public function getPasien($id)
    {
        $data = BmPasien::where('KD_UNIT', $id)->first();
        return $data;
    }
}
