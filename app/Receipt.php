<?php

namespace App;

use App\Material;
use App\ReceiptDetail;
use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    protected $fillable = [
        'code', 'date', 'vendor_id', 'head_id', 'user_id', 'name', 'status'
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id', 'kd_vendor');
    }

    public function head()
    {
        return $this->belongsTo(Head::class);
    }

    public function detail()
    {
        return $this->hasMany(ReceiptDetail::class);
    }

    public function getNameMaterial($id)
    {
        $material = Material::findOrFail($id)->first();
        $material = $material->name;

        return $material;
    }

    public function getMaterial($material)
    {
        $hari_ini = date("Y-m-d");
        $tgl_pertama = date('Y-m-01', strtotime($hari_ini));
        $tgl_terakhir = date('Y-m-t', strtotime($hari_ini));

        $data = ReceiptDetail::where([
                ['material_id', $material],
                ['date', '>=', $tgl_pertama],
                ['date', '<=', $tgl_terakhir],
            ])
            ->get()->sum('jumlah');
        if (!$data){
            return false;
        } else {
            return true;
        }
    }


}
