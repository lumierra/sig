<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Head extends Model
{
    protected $fillable = ['name', 'status', 'user_id'];

}
