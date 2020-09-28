<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spend extends Model
{
    protected $connection = 'sqlsrv_server2';
    protected $table = 'GZ_PENGELUARAN';

    protected $fillable = [
      'code', 'date', 'tujuan', 'name', 'status', 'user_id', 'place_id',
    ];

    public function detail()
    {
        return $this->hasMany(SpendDetail::class);
    }

    public function place()
    {
        return $this->belongsTo(Place::class);
    }

}
