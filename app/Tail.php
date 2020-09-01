<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tail extends Model
{
    protected $fillable = ['receipt_id', 'receipt_code', 'material_id', 'unit_id', 'user_id', 'jumlah', 'keterangan'];
}
