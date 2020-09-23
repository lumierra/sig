<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    protected $connection = 'sqlsrv_2';
    protected $table = 'vendor';
}
