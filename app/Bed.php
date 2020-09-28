<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bed extends Model
{
    protected $connection = 'sqlsrv_server2';
    protected $table = 'VIEW_BM_KAMAR';
    protected $primaryKey = 'KD_RUANG';

}
