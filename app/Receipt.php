<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    protected $fillable = [
        'code', 'date', 'vendor_id', 'head_id', 'user_id', 'name', 'status'
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function head()
    {
        return $this->belongsTo(Head::class);
    }


}
