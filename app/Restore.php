<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restore extends Model
{

    protected $connection = 'sqlsrv_server2';
    protected $table = 'GZ_PENGEMBALIAN';

    protected $fillable = [
        'code', 'date', 'dari', 'name', 'status', 'user_id', 'place_id'
    ];

    public function detail()
    {
        return $this->hasMany(RestoreDetail::class);
    }

    public function place()
    {
        return $this->belongsTo(Place::class);
    }
}
