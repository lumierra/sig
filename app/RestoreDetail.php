<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RestoreDetail extends Model
{
    protected $connection = 'sqlsrv_server2';
    protected $table = 'GZ_DETAIL_PENGEMBALIAN';

    protected $fillable = [
        'date', 'restore_id', 'restore_code', 'material_id', 'unit_id', 'user_id', 'jumlah', 'keterangan',
    ];

    public function restore()
    {
        return $this->belongsTo(Restore::class);
    }

    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}
