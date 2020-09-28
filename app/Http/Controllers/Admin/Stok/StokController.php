<?php

namespace App\Http\Controllers\Admin\Stok;

use App\Http\Controllers\Controller;
use App\Material;
use App\Receipt;
use App\ReceiptDetail;
use App\RestoreDetail;
use App\SpendDetail;
use App\Stock;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class StokController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $data = array();
        $temp = new Receipt();
        $receipts = ReceiptDetail::all();
        foreach ($receipts as $receipt){
            $name = Material::findOrFail($receipt->material_id);
            if (!in_array($name, $data)){
                array_push($data, $name);
            }
        }

        if ($request->ajax()) {
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('stok', function ($row){
                    return $this->kalkulasi($row->id);
                })

                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-info btn-circle btn-sm editProduct"><i class="fas fa-edit"></i></a>';

                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-circle btn-sm deleteProduct"><i class="fas fa-trash"></i></a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.stok.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function kalkulasi($material)
    {
        $hari_ini = date("Y-m-d");
        $tgl_pertama = date('Y-m-01', strtotime($hari_ini));
        $tgl_terakhir = date('Y-m-t', strtotime($hari_ini));

        $masuk = ReceiptDetail::where([
            ['material_id', $material],
            ['date', '>=', $tgl_pertama],
            ['date', '<=', $tgl_terakhir],
        ])
            ->get()->sum('jumlah');

        $retur = RestoreDetail::where([
            ['material_id', $material],
            ['date', '>=', $tgl_pertama],
            ['date', '<=', $tgl_terakhir],
        ])
            ->get()->sum('jumlah');

        $keluar = SpendDetail::where([
            ['material_id', $material],
            ['date', '>=', $tgl_pertama],
            ['date', '<=', $tgl_terakhir],
        ])
            ->get()->sum('jumlah');

        $data = ($masuk + $retur) - $keluar;

        return $data;
    }
}
