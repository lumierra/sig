<?php

namespace App\Http\Controllers\Admin\Pengeluaran;

use Alert;
use App\One;
use App\Head;
use App\Receipt;
use App\ReceiptDetail;
use App\SpendDetail;
use App\Tail;
use DateTime;
use App\Unit;
use App\Stock;
use App\Place;
use App\Spend;
use App\Demand;
use App\Detail;
use App\Vendor;
use App\Material;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class PengeluaranController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Spend::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('place', function (Spend $spend) {
                    return $spend->place->name;
                })
                ->addColumn('action', function($row){
                    $route = 'pengeluaran/' . $row->id . '/' . 'edit';
                    $btn = '';
                    $btn = $btn.' <a href="javascript:void(0)" data-target="#exampleModal" data-toggle="modal"  data-id="'.$row->id.'" data-original-title="Show" class="btn btn-success btn-circle btn-sm showProduct"><i class="fas fa-eye"></i></a>';
                    $btn = $btn.' <a href="' . $route . '" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="btn btn-info btn-circle btn-sm"><i class="fas fa-edit"></i></a>';
                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-circle btn-sm deleteProduct"><i class="fas fa-trash"></i></a>';

                    return $btn;
                })
                ->editColumn('date', function ($row) {
                    return [
                        'display' => e($row->created_at->format('d/m/Y h:i:s')),
                        'timestamp' => $row->created_at->timestamp
                    ];
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $heads = Head::all();
        $vendors = Vendor::all();
        return view('admin.pengeluaran.index')->with([
            'heads' => $heads,
            'vendors' => $vendors,
        ]);
    }

    public function create()
    {
        $materials = Material::all();
        $units = Unit::all();
        $places = Place::all();
        $data = array();

        $temp = new Receipt();
        $receipts = ReceiptDetail::all();

        foreach ($receipts as $receipt){
            $name = Material::findOrFail($receipt->material_id);
            if (!in_array($name, $data)){
                array_push($data, $name);
            }
        }

        return view('admin.pengeluaran.create2')->with([
            'materials' => $materials,
            'units' => $units,
            'places' => $places,
            'data' => $data,
        ]);
    }

    public function store(Request $request)
    {
        if ($request->jumlah[0] > $this->kalkulasi($request->material[0])){
            Alert::success('Berhasil', 'berhasill');
            return redirect()->route('admin.pengeluaran.index');
        } else {
            Alert::error('Erorr', 'gagal');
            return redirect()->back();
        }
//        $counter = count($request->jumlah);
//
//        $today = new DateTime();
//        $month = $today->format('m');
//        $year = $today->format('Y');
//        $now = '2020';
//
//        $lastID = Spend::select('code')->orderBy('id', 'desc')->first();
//        if (!$lastID){
//            $newID = 'Pengeluaran-RSGZ/000001/' . $month . '/' . $year;
//        }
//        else{
//            if ($year == $now){
//                $lastIncrement = substr($lastID->code, 17, 6);
//                $newIncrement = 'Pengeluaran-RSGZ/' . str_pad($lastIncrement + 1, 6, 0, STR_PAD_LEFT);
//                $newID = $newIncrement . '/' . $month . '/' . $year;
//            }
//            else {
//                if ($year != $now){
//                    $newID = 'Pengeluaran-RSGZ/000001/' . $month . '/' . $year;
//                } else {
//                    $lastIncrement = substr($lastID->code, 17, 6);
//                    $newIncrement = 'Pengeluaran-RSGZ/' . str_pad($lastIncrement + 1, 6, 0, STR_PAD_LEFT);
//                    $newID = $newIncrement . '/' . $month . '/' . $year;
//                }
//            }
//        }
//
//        $spend = Spend::create([
//            'code' => $newID,
//            'date' => new DateTime(),
//            'place_id' => $request->place,
//            'user_id' => Auth::user()->id,
//            'name' => $newID,
//        ]);
//
//        $find = Spend::where('code', $newID)->first();
//
//        if ($counter > 1){
//            for ($i=0; $i < $counter; $i++){
//                SpendDetail::create([
//                    'date' => new DateTime(),
//                    'spend_id' => $find->id,
//                    'spend_code' => $find->code,
//                    'material_id' => $request->material[$i],
//                    'unit_id' => $request->unit[$i],
//                    'user_id' => Auth::user()->id,
//                    'jumlah' => (int)$request->jumlah[$i],
//                    'keterangan' => $request->keterangan[$i],
//                ]);
//            }
//        }
//        else {
//            SpendDetail::create([
//                'date' => new DateTime(),
//                'spend_id' => $find->id,
//                'spend_code' => $find->code,
//                'material_id' => $request->material[0],
//                'unit_id' => $request->unit[0],
//                'user_id' => Auth::user()->id,
//                'jumlah' => (int)$request->jumlah[0],
//                'keterangan' => $request->keterangan[0],
//            ]);
//        }
//
//        if (!$spend){
//            Alert::error('Gagal', 'Data Gagal Di Tambah');
//        } else {
//            Alert::success('Berhasil', 'Data Berhasil Di Tambah');
//        }

//        return redirect()->route('admin.pengeluaran.index');
    }

    public function show($id)
    {
        $spend = Spend::find($id);
        return view('admin.pengeluaran.show')->with('spend', $spend);
    }

    public function showSpend($id)
    {
        $spend = Spend::find($id);
        return view('admin.pengeluaran.show')->with('spend', $spend);
    }

    public function edit($id)
    {
        $spend = Spend::find($id);
        $materials = Material::all();
        $units = Unit::all();
        $places = Place::all();

        return view('admin.pengeluaran.edit')->with([
            'spend' => $spend,
            'materials' => $materials,
            'units' => $units,
            'places' => $places,
        ]);
    }

    public function update(Request $request, $id)
    {
        $spend = Spend::find($id);
        $counter = count($request->jumlah);
        $counterDetail = count($spend->detail);

        $spend->update([
            'place_id' => $request->place,
            'user_id' => Auth::user()->id,
        ]);

        if ($counter > $counterDetail){
            foreach ($spend->detail as $i => $detail){
                One::destroy($detail->id);
            }
            for($i=0; $i < $counter; $i++){
                SpendDetail::create([
                    'date' => new DateTime(),
                    'spend_id' => $spend->id,
                    'spend_code' => $spend->code,
                    'material_id' => $request->material[$i],
                    'unit_id' => $request->unit[$i],
                    'user_id' => Auth::user()->id,
                    'jumlah' => (int)$request->jumlah[$i],
                    'keterangan' => $request->keterangan[$i],
                ]);
            }
        }
        else {
            foreach ($spend->detail as $i => $detail){
                $item = SpendDetail::find($detail->id);
                $item->update([
                    'material_id' => $request->material[$i],
                    'unit_id' => $request->unit[$i],
                    'user_id' => Auth::user()->id,
                    'jumlah' => (int)$request->jumlah[$i],
                    'keterangan' => $request->keterangan[$i],
                ]);
            }
        }

        if (!$spend){
            Alert::error('Gagal', 'Data Gagal Di Ubah');
        }else {
            Alert::success('Berhasil', 'Data Berhasil Di Ubah');
        }
        return redirect()->route('admin.pengeluaran.index');
    }

    public function destroy($id)
    {
        Spend::find($id)->delete();

        foreach ($spend->detail as $detail){
            $item = SpendDetail::where('spend_id', $spend->id)->first();
            $item->delete();
        }

        return response()->json(['success'=>'Pengeluaran Berhasil Di Hapus']);
    }

    public function cekBahan($material)
    {
        $stock = Stock::where('material_id', $material)->first();

//        return $stock->total;
        return response()->json($stock->total);
    }

    public function cekStok($material)
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

        return response()->json($data);
    }

    public function cekPengeluaran($material)
    {
        $hari_ini = date("Y-m-d");
        $tgl_pertama = date('Y-m-01', strtotime($hari_ini));
        $tgl_terakhir = date('Y-m-t', strtotime($hari_ini));

        $data = SpendDetail::where([
            ['material_id', $material],
            ['date', '>=', $tgl_pertama],
            ['date', '<=', $tgl_terakhir],
        ])
            ->get()->sum('jumlah');

        return response()->json($data);
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

        $keluar = SpendDetail::where([
            ['material_id', $material],
            ['date', '>=', $tgl_pertama],
            ['date', '<=', $tgl_terakhir],
        ])
            ->get()->sum('jumlah');

        $data = $masuk - $keluar;

        return response()->json($data);
    }
}
