<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penyakit extends Model
{
    protected $connection = 'sqlsrv_server2';
    protected $table = 'MR_PENYAKIT';
}
