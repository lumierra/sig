<?php

namespace App\Http\Controllers\Admin\Permintaan;

use Alert;
use App\Head;
use App\Unit;
use DateTime;
use App\Detail;
use App\Demand;
use App\Vendor;
use App\Material;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PermintaanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Demand::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('vendor', function (Demand $demand) {
                    return $demand->vendor->nama_vendor;
                })
                // ->addColumn('head', function (Demand $demand) {
                //     return '$demand->head->name';
                // })
                ->addColumn('action', function($row){
                    $route = 'permintaan/' . $row->id . '/' . 'edit';
                    $route2 = 'penerimaan/' . $row->id . '/' . 'create2';
                    $btn = '';
//                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-info btn-circle btn-sm editProduct"><i class="fas fa-edit"></i></a>';
                    $btn = $btn.' <a href="javascript:void(0)" data-target="#exampleModal" data-toggle="modal"  data-id="'.$row->id.'" data-original-title="Show" class="btn btn-success btn-circle btn-sm showProduct"><i class="fas fa-eye"></i></a>';
                    $btn = $btn.' <a href="' . $route . '" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="btn btn-info btn-circle btn-sm"><i class="fas fa-edit"></i></a>';
                    $btn = $btn.' <a href="' . $route2 . '" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Create" class="btn btn-warning btn-circle btn-sm"><i class="fas fa-plus-circle"></i></a>';
                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-circle btn-sm deleteProduct"><i class="fas fa-trash"></i></a>';

                    return $btn;
                })
                ->editColumn('date', function ($row) {
                    return [
                        'display' => e($row->created_at->format('d/m/Y')),
                        'timestamp' => $row->created_at->timestamp
                    ];
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        // $heads = Head::all();
        $vendors = Vendor::all();
        return view('admin.permintaan.index')->with([
            // 'heads' => $heads,
            'vendors' => $vendors,
        ]);
    }

    public function create()
    {
        $vendors = Vendor::all();
        $heads = Head::all();
        $materials = Material::all();
        $units = Unit::all();

        return view('admin.permintaan.create')->with([
            'vendors' => $vendors,
            'heads' => $heads,
            'materials' => $materials,
            'units' => $units,
        ]);
    }

    public function create2($id)
    {
        $data = Demand::find($id);
        $vendors = Vendor::all();
        $heads = Head::all();
        $units = Unit::all();
        $materials = Material::all();
        $demands = Demand::all();

        return view('admin.penerimaan.create2')->with([
            'data' => $data,
            'vendors' => $vendors,
            'heads' => $heads,
            'units' => $units,
            'materials' => $materials,
            'demands' => $demands,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'vendors' => 'required',
            'heads' => 'required',
//            'jumlah[]' => 'required',
//            'material[]' => 'required',
//            'unit[]' => 'required',
//            'keterangan[]' => 'required'
        ], [
            'vendors.required' => 'Vendor Belum di isi',
            'heads.required' => 'Penanggung Jawab Belum di isi',
//            'jumlah[].required' => 'Jumlah Belum di isi',
//            'material[].required' => 'Bahan Makanan Belum di pilih',
//            'unit[].required' => 'Nama Satuan Belum di pilih',
//            'keterangan[].required' => 'Keterangan Belum di isi',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.permintaan.create')
                ->withErrors($validator)
                ->withInput();
        }

        $counter = count($request->jumlah);

        $today = new DateTime();
        $month = $today->format('m');
        $year = $today->format('Y');
        $now = '2020';

        $lastID = Demand::select('code')->orderBy('id', 'desc')->first();
        if (!$lastID){
//            $newID = 'Permintaan-RSGZ/000001/' . $month . '/' . $year;
            $newID = '000001/BM/IG/RSUD-LGS/' . $month . '/' . $year;
        }
        else{
            if ($year == $now){
                $lastIncrement = substr($lastID->code, 0, 6);
                $newIncrement = str_pad($lastIncrement + 1, 6, 0, STR_PAD_LEFT) . '/BM/IG/RSUD-LGS/' . $month . '/' . $year;
                $newID = $newIncrement;
            }
            else {
                if ($year != $now){
                    $newID = '000001/BM/IG/RSUD-LGS/' . $month . '/' . $year;
                }
                else {
                    $lastIncrement = substr($lastID->code, 0, 6);
                    $newIncrement = str_pad($lastIncrement + 1, 6, 0, STR_PAD_LEFT) . '/BM/IG/RSUD-LGS/' . $month . '/' . $year;
                    $newID = $newIncrement;
                }
            }
        }

        $demand = Demand::create([
            'code' => $newID,
            'date' => new DateTime(),
            'vendor_id' => $request->vendors,
            'head_id' => $request->heads,
            'user_id' => Auth::user()->id,
            'name' => $newID,
        ]);

        $find = Demand::where('code', $newID)->first();

        if ($counter > 1){
            for ($i=0; $i < $counter; $i++){
                Detail::create([
                    'demand_id' => $find->id,
                    'demand_code' => $newID,
                    'material_id' => $request->material[$i],
                    'unit_id' => $request->unit[$i],
                    'user_id' => Auth::user()->id,
                    'jumlah' => (int)$request->jumlah[$i],
                    'keterangan' => $request->keterangan[$i],
                ]);
            }
        }
        else {
            Detail::create([
                'demand_id' => $find->id,
                'demand_code' => $newID,
                'material_id' => $request->material[0],
                'unit_id' => $request->unit[0],
                'user_id' => Auth::user()->id,
                'jumlah' => (int)$request->jumlah[0],
                'keterangan' => $request->keterangan[0],
            ]);
        }
        if (!$demand){
            Alert::error('Gagal', 'Data Gagal Di Tambah');
        } else {
            Alert::success('Berhasil', 'Data Berhasil Di Tambah');
        }

        return redirect()->route('admin.permintaan.index');
    }

    public function show($id)
    {
        return 'asd';
    }

    public function showDemand($id)
    {
        $demand = Demand::find($id);
        return view('admin.permintaan.show')->with('demand', $demand);
    }

    public function edit($id)
    {
        $demand = Demand::find($id);
        $vendors = Vendor::all();
        $heads = Head::all();
        $materials = Material::all();
        $units = Unit::all();

        return view('admin.permintaan.edit2')->with([
            'demand' => $demand,
            'vendors' => $vendors,
            'heads' => $heads,
            'materials' => $materials,
            'units' => $units,
        ]);
    }

    public function update(Request $request, $id)
    {

        $demand = Demand::find($id);
        $counter = count($request->jumlah);
        $counterDetail = count($demand->detail);

        $validator = Validator::make($request->all(), [
            'vendors' => 'required',
            'heads' => 'required',
//            'jumlah[]' => 'required',
//            'material[]' => 'required',
//            'unit[]' => 'required',
//            'keterangan[]' => 'required'
        ], [
            'vendors.required' => 'Vendor Belum di isi',
            'heads.required' => 'Penanggung Jawab Belum di isi',
//            'jumlah[].required' => 'Jumlah Belum di isi',
//            'material[].required' => 'Bahan Makanan Belum di pilih',
//            'unit[].required' => 'Nama Satuan Belum di pilih',
//            'keterangan[].required' => 'Keterangan Belum di isi',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.permintaan.edit', $demand->id)
                ->withErrors($validator)
                ->withInput();
        }

        $demand->update([
            'vendor_id' => $request->vendors,
            'head_id' => $request->heads,
            'user_id' => Auth::user()->id,
        ]);

        foreach ($demand->detail as $i => $detail){
            Detail::destroy($detail->id);
        }
        for($i=0; $i < $counter; $i++){
            Detail::create([
                'demand_id' => $demand->id,
                'demand_code' => $demand->code,
                'material_id' => $request->material[$i],
                'unit_id' => $request->unit[$i],
                'user_id' => Auth::user()->id,
                'jumlah' => (int)$request->jumlah[$i],
                'keterangan' => $request->keterangan[$i],
            ]);
        }

//        if ($counter > $counterDetail){
//            foreach ($demand->detail as $i => $detail){
//                Detail::destroy($detail->id);
//            }
//            for($i=0; $i < $counter; $i++){
//                Detail::create([
//                    'demand_id' => $demand->id,
//                    'demand_code' => $demand->code,
//                    'material_id' => $request->material[$i],
//                    'unit_id' => $request->unit[$i],
//                    'user_id' => Auth::user()->id,
//                    'jumlah' => (int)$request->jumlah[$i],
//                    'keterangan' => $request->keterangan[$i],
//                ]);
//            }
//        }
//        else {
//            foreach ($demand->detail as $i => $detail){
//                $item = Detail::find($detail->id);
//                $item->update([
//                    'material_id' => $request->material[$i],
//                    'unit_id' => $request->unit[$i],
//                    'user_id' => Auth::user()->id,
//                    'jumlah' => (int)$request->jumlah[$i],
//                    'keterangan' => $request->keterangan[$i],
//                ]);
//            }
//        }

        if (!$demand){
            Alert::error('Gagal', 'Data Gagal Di Ubah');
        } else {
            Alert::success('Berhasil', 'Data Berhasil Di Ubah');
        }

        return redirect()->route('admin.permintaan.index');

    }

    public function destroy($id)
    {
        $demand = Demand::find($id)->delete();

        foreach ($demand->detail as $detail){
            $detail->delete();
        }
        return response()->json(['success'=>'Permintaan deleted successfully.']);
    }

    public function delete($id)
    {
        $demand = Demand::find($id);
        foreach ($demand->detail as $detail){
            $detail->delete();
        }
        $demand->delete();

        return response()->json(['success'=>'Permintaan deleted successfully.']);
    }

    public function cekBahan($id)
    {
        $material = Material::find($id);

        return $material->unit->id;
    }
}
