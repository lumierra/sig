<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Demand extends Model
{
    protected $fillable = ['code', 'name', 'date', 'user_id', 'vendor_id', 'head_id'];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function head()
    {
        return $this->belongsTo(Head::class);
    }
}
