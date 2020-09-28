<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    protected $connection = 'sqlsrv_server2';
    protected $table = 'GZ_TEMPAT';

    protected $fillable = ['name'];

    public function spend()
    {
        return $this->hasOne(Spend::class);
    }

    public function restore()
    {
        return $this->hasOne(Restore::class);
    }

}
