<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $connection = 'sqlsrv_server2';
    protected $table = 'GZ_ROLES';

    protected $fillable = [
        'name'
    ];
}
