<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class BmPasien extends Model
{
    protected $connection = 'sqlsrv_server2';
    protected $table = 'VIEW_BM_PASIEN_AKTIF';

    public function unit()
    {
        return $this->hasMany(RuangUnit::class, 'KD_UNIT', 'KD_UNIT');
    }

    public function getPatient()
    {
        return $this->hasMany(Bed::class, 'KD_UNIT', 'KD_UNIT');
    }

    public function getDokter($id)
    {
        $query = DB::connection('sqlsrv_server2')
            ->table('PASIEN_INAP')
            ->join('TRANSAKSI', function ($join){
                $join->on('PASIEN_INAP.KD_KASIR', '=', 'TRANSAKSI.KD_KASIR')->on('PASIEN_INAP.NO_TRANSAKSI', '=', 'TRANSAKSI.NO_TRANSAKSI');
            })
            ->join('PASIEN', 'TRANSAKSI.KD_PASIEN', '=', 'PASIEN.KD_PASIEN')
            ->join('KUNJUNGAN', 'TRANSAKSI.KD_PASIEN', '=', 'KUNJUNGAN.KD_PASIEN')
            ->leftJoin('SJP_KUNJUNGAN', function($join){
                $join->on('SJP_KUNJUNGAN.KD_PASIEN', '=', 'KUNJUNGAN.KD_PASIEN')
                ->on('SJP_KUNJUNGAN.KD_UNIT', '=', 'KUNJUNGAN.KD_UNIT')
                ->on('SJP_KUNJUNGAN.TGL_MASUK', '=', 'KUNJUNGAN.TGL_MASUK')
                ->on('SJP_KUNJUNGAN.URUT_MASUK', '=', 'KUNJUNGAN.URUT_MASUK');
            })
            ->join('DOKTER', 'KUNJUNGAN.KD_DOKTER', '=', 'DOKTER.KD_DOKTER')
            ->join('DOKTER_NAMA', 'KUNJUNGAN.KD_DOKTEr', '=', 'DOKTER_NAMA.KD_DOKTER')
            ->join('spesialisasi', function($join){
                $join->on('spesialisasi.KD_SPESIAL', '=', 'PASIEN_INAP.KD_SPESIAL')
                ->on('TRANSAKSI.TGL_TRANSAKSI', '=', 'KUNJUNGAN.TGL_MASUK')
                ->on('TRANSAKSI.KD_UNIT', '=', 'KUNJUNGAN.KD_UNIT')
                ->on('TRANSAKSI.URUT_MASUK', '=', 'KUNJUNGAN.URUT_MASUK');
            })
            ->join('CUSTOMER', 'KUNJUNGAN.KD_CUSTOMER', '=', 'CUSTOMER.KD_CUSTOMER')
            ->leftJoin('KONTRAKTOR', function($join){
                $join->on('KONTRAKTOR.KD_CUSTOMER', '=', 'CUSTOMER.KD_CUSTOMER');
            })
            ->join('UNIT', 'PASIEN_INAP.KD_UNIT', '=', 'UNIT.KD_UNIT')
            ->join('KELAS', 'UNIT.KD_KELAS', '=', 'KELAS.KD_KELAS')
            ->join('TARIF_CUST', 'KUNJUNGAN.KD_CUSTOMER', '=', 'TARIF_CUST.KD_CUSTOMER')
            ->where([
                ['PASIEN.KD_PASIEN', '=', $id],
                ['KUNJUNGAN.TGL_KELUAR', '=', null],
                ['TRANSAKSI.TGL_DOK', '=', null]

            ])
            ->whereIn('TRANSAKSI.KD_UNIT', function ($query){
                $query->select('KD_UNIT')->from('UNIT')->where('Parent', '=', '1001');
            })
            ->whereIn('PASIEN_INAP.KD_UNIT', function ($query){
                $query->select('KD_UNIT')->from('UNIT')->where('Parent', '=', '1001');
            })
            ->select('DOKTER.KD_DOKTER','DOKTER_NAMA.NAMA_LENGKAP')
            ->get();

        $query = $query[0]->NAMA_LENGKAP;

        return $query;
    }

    public function getDiagnosa($id)
    {
        $data = DB::connection('sqlsrv_server2')
            ->table('MR_PENYAKIT')
            ->join('PENYAKIT', 'MR_PENYAKIT.KD_PENYAKIT', '=', 'PENYAKIT.KD_PENYAKIT')
            ->join('UNIT', 'MR_PENYAKIT.KD_UNIT', '=', 'UNIT.KD_UNIT')
            ->where([
                ['MR_PENYAKIT.KD_PASIEN', '=', $id],
                ['MR_PENYAKIT.URUT_MASUK', '>', 0],
                ['MR_PENYAKIT.TGL_MASUK', '>=', DB::raw("( SELECT TGL_MASUK FROM VIEW_BM_PASIEN_AKTIF WHERE KD_PASIEN = '$id' ) ")]

            ])
            ->select('MR_PENYAKIT.KD_PENYAKIT', 'PENYAKIT.PENYAKIT', 'MR_PENYAKIT.TGL_MASUK', 'UNIT.NAMA_UNIT')
            ->get();

        return $data;
    }

}
