<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpendDetail extends Model
{

    protected $connection = 'sqlsrv_server2';
    protected $table = 'GZ_DETAIL_PENGELUARAN';

    protected $fillable = [
        'date', 'spend_id', 'spend_code', 'material_id', 'unit_id', 'user_id', 'jumlah', 'keterangan'
    ];

    public function spend()
    {
        return $this->belongsTo(Spend::class);
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
